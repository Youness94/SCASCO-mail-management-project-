<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActGestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function productions()
    {
        return $this->hasMany(Production::class);
    }

    public function chargeComptes()
    {
        return $this->belongsToMany(ChargeCompte::class, 'productions', 'act_gestion_id', 'charge_compte_id')
            ->using(ActesGestionProductionCategorie::class)
            ->withPivot(['categorie_id', 'production_id'])
            ->withTimestamps();
    }
   
}
