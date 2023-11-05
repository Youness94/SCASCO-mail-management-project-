<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeCompte extends Model
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
    public function actGestions()
    {
        return $this->belongsToMany(ActGestion::class, 'productions', 'charge_compte_id', 'act_gestion_id')
            ->using(ActesGestionProductionCategorie::class)
            ->withPivot(['categorie_id', 'production_id'])
            ->withTimestamps();
    }
}
