<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // Relacion uno a muchos(inversa)
    public function escape(){

        return $this->belongsTo(Escape::class);
    }


    // Relacion uno a muchos
    public function users(){

        return $this->hasMany(User::class);
    }

}
