<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'images', // Agregar este campo
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    public function adminlte_logo()
    {
        return $this->name ?? 'AdminLTE';
    }
    public function adminlte_image()
{
    return $this->images ? asset($this->images) : asset('vendor/adminlte/dist/img/default-user.png');
}

    
    public function image()
    {
        return $this->hasOne(Image::class); // Relación con el modelo Image
    }
        // Función para obtener la imagen del usuario
        public function getProfileImageAttribute()
        {
            return $this->images ? asset($this->images) : asset('default-user.png');
        }

}