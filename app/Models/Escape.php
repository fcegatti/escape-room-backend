<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escape extends Model
{
    use HasFactory;

    // Relacion muchos a muchos
    public function problems(){

        return $this->belongsToMany(Problem::class);
    }

    // Relacion uno a muchos
    public function rooms(){   
             
        return $this->hasMany(Room::class);
    }
}

// return $this->belongsToMany(Problem::class ,'escape_problem ', 'escape_id', 'problem_id'); PUEDO PRECINDIR DE ESOS PARAMETROS CON LARAVEL