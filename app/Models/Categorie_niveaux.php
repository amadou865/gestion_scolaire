<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie_niveaux extends Model
{
    use HasFactory;

    protected $fillable = ['categorie_niveau'];

    public function niveaux()
        {
            return $this->hasMany(Niveau::class);
        }
}
