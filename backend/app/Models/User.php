<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'images', // ✅ Se cambió a 'images' para coincidir con la base de datos
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Accesor para obtener la URL de la imagen correctamente
    public function getImageUrlAttribute()
    {
        return $this->images ? asset('storage/' . $this->images) : asset('vendor/adminlte/dist/img/default-user.png');
    }

    // Para que AdminLTE muestre la imagen correcta
    public function adminlte_image()
    {
        return $this->image_url;
    }
}
