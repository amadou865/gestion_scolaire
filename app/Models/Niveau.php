<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;

    protected $fillable = ['nom_niveau', 'categorie_niveaux_id'];

    public function categorie_niveaux()
        {
            return $this->belongsTo(categorie_niveaux::class);
        }

    public function classes()
        {
            return $this->hasMany(classe::class);
        }
}
