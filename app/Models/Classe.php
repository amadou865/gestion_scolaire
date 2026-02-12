<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = ['nom_classe', 'code_classe', 'filiere_id', 'niveau_id'];

    public function filiere()
        {
            return $this->belongsTo(Filiere::class);
        }

        public function niveau()
            {
                return $this->belongsTo(Niveau::class);
            }

    public function tarifs()
        {
            return $this->hasMany(Tarif::class);
        }
}
