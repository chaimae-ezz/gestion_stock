<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{

    protected $fillable = [
        'produit_id',
        'type_mouvement',
        'quantite',
        'quantite_avant',
        'quantite_apres',
        'motif',
        'reference_document',
        'utilisateur_id',
        'notes',
        'date_mouvement',
    ];

    protected $casts = [
        'date_mouvement' => 'datetime',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }
}
