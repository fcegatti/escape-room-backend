<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    public function clues() {
      return $this->hasMany(Clue::class);
    }

    public function images() {
      return $this->hasMany(Image::class);
    }
}


