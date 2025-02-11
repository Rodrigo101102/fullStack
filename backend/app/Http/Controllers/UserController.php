<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Mostrar la lista de usuarios.
     */
   // UserController.php

public function index(Request $request)
{
    $search = $request->get('search');  // Captura la búsqueda

    // Si hay una búsqueda, filtra los usuarios por nombre
    if ($search) {
        // Filtra los usuarios por nombre y aplica la paginación
        $usuarios = User::where('name', 'like', '%' . $search . '%')
                        ->orderBy('id', 'asc')
                        ->paginate(5);  // Paginación de 5 resultados por página
    } else {
        // Si no hay búsqueda, simplemente muestra todos los usuarios
        $usuarios = User::orderBy('id', 'asc')->paginate(5);
    }

    return view('users.index', compact('usuarios'));
}

    

    /**
     * Mostrar el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $profileImagePath = null;
    
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $profileImagePath = 'images/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImagePath);
        }
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'images' => $profileImagePath ?? null, // Manejo de imagen nula
        ]);
    
        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }
    

    /**
     * Mostrar el formulario de edición de un usuario.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar la información de un usuario.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Manejo de la imagen
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $profileImagePath = 'images/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $profileImagePath);

            // Eliminar imagen anterior si existe
            if ($user->images && File::exists(public_path($user->images))) {
                File::delete(public_path($user->images));
            }

            $data['images'] = $profileImagePath;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy(User $user)
    {
        // Eliminar la imagen si existe antes de eliminar al usuario
        if ($user->images && File::exists(public_path($user->images))) {
            File::delete(public_path($user->images));
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
