<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;




class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'designation',
        'description',
        'prix',
        'quantite_stock',
        'seuil_alerte',
        'fournisseur_id',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function mouvements()
    {
        return $this->hasMany(MouvementStock::class);
    }
}

