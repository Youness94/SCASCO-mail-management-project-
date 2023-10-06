<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinistre extends Model
{
    use HasFactory;
    protected $table = 'sinistres';

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    public function charge_compte_sinistres()
    {
        return $this->belongsTo(ChargeCompteSinistres::class, 'charge_compte_sinistre_id');
    }
    
    public function branches_sinistres()
    {
        return $this->belongsTo(BranchSinistresAtRd::class,  'branche_sinistre_id');
    }

    public function compagnies()
    {
        return $this->belongsTo(Compagnie::class,  'compagnie_id');
    }

    public function acte_de_gestion_sinistres()
    {
        return $this->belongsTo(ActeDeGestionSinistresAtRd::class, 'acte_de_gestion_sinistre_id');
    }
}
