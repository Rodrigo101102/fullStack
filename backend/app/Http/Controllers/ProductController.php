<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {
    // Muestra los productos
    public function index(Request $request)
    {
        // Obtener las categorías para el filtro
        $categorias = Categoria::all();
    
        // Filtro de búsqueda
        $query = Producto::query();
    
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nombre', 'LIKE', "%{$request->search}%");
        }
    
        if ($request->has('categoria') && !empty($request->categoria)) {
            $query->where('categoria_id', $request->categoria);
        }
    
        $products = $query->latest()->paginate(10);
    
        return view('productos.index', compact('products', 'categorias'));
    }
    

    // Muestra el formulario para agregar un producto
    public function create() {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // Guarda un nuevo producto en la base de datos
    public function store(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'talla' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'estado' => 'required|string|in:disponible,agotado', // Ajustado a valores de la BD
            'destacado' => 'nullable|boolean',
        ]);

        // Verificar si hay imagen y guardarla en la ruta correcta
        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('images/productos', 'public');
        }

        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $imagePath,
            'categoria_id' => $request->categoria_id,
            'talla' => $request->talla ?? null, 
            'color' => $request->color ?? null, 
            'estado' => strtolower(trim($request->estado)), // Se ajusta el valor a la BD
            'destacado' => $request->has('destacado') ? 1 : 0,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Muestra el formulario para editar un producto
    public function edit(Producto $producto) {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualiza la información del producto
    public function update(Request $request, Producto $producto) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
            'talla' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'estado' => 'required|string|in:disponible,agotado', // Ajustado a valores de la BD
            'destacado' => 'nullable|boolean',
        ]);

        // Verificar si hay nueva imagen y reemplazar la anterior
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $imagePath = $request->file('imagen')->store('images/productos', 'public');
            $producto->imagen = $imagePath;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
            'talla' => $request->talla ?? null, 
            'color' => $request->color ?? null, 
            'estado' => strtolower(trim($request->estado)), // Se ajusta el valor a la BD
            'destacado' => $request->has('destacado') ? 1 : 0,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Elimina un producto de la base de datos
    public function destroy(Producto $producto) {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
