<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $usuarios = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->orderBy('id', 'asc')->paginate(5);

        return view('users.index', compact('usuarios'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' // ✅ Se cambió a 'images'
        ]);

        $imagePath = $request->hasFile('images') ? $request->file('images')->store('images', 'public') : null;

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'images' => $imagePath, // ✅ Se cambió a 'images'
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // ✅ Se cambió a 'images'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('images')) { // ✅ Se cambió a 'images'
            $imagePath = $request->file('images')->store('images', 'public');

            if ($user->images && File::exists(storage_path('app/public/' . $user->images))) {
                File::delete(storage_path('app/public/' . $user->images));
            }

            $data['images'] = $imagePath; // ✅ Se cambió a 'images'
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        if ($user->images && File::exists(storage_path('app/public/' . $user->images))) {
            File::delete(storage_path('app/public/' . $user->images));
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
