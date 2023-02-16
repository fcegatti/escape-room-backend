<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Escape extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'status',
        'time',
        'init_time',
        'stage',
        'rooms_amount',
    ];

    // Relacion muchos a muchos
    public function problems(){

        return $this->belongsToMany(Problem::class);
    }

    // Relacion uno a muchos
    public function rooms(){   
             
        return $this->hasMany(Room::class);
    }

    public function users(){   
             
        return $this->hasMany(User::class);
    }
}

// return $this->belongsToMany(Problem::class ,'escape_problem ', 'escape_id', 'problem_id'); PUEDO PRECINDIR DE ESOS PARAMETROS CON LARAVEL