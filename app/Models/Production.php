<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    public function charge_comptes()
    {
        return $this->belongsTo(ChargeCompte::class, 'charge_compte_id');
    }
    
    public function branches()
    {
        return $this->belongsTo(Branche::class,  'branche_id');
    }

    public function compagnies()
    {
        return $this->belongsTo(Compagnie::class,  'compagnie_id');
    }

    public function act_gestions()
    {
        return $this->belongsTo(ActGestion::class, 'act_gestion_id');
    }

}

