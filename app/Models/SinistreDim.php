<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinistreDim extends Model
{
    use HasFactory;
    protected $table = 'sinistres_dim';

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    public function charge_compte_dim()
    {
        return $this->belongsTo(ChargeCompteDim::class, 'charge_compte_dim_id');
    }
    
    public function branches_dim()
    {
        return $this->belongsTo(BrancheDim::class,  'branche_dim_id');
    }

    public function compagnies()
    {
        return $this->belongsTo(Compagnie::class,  'compagnie_id');
    }

    public function acte_de_gestion_dim()
    {
        return $this->belongsTo(ActeGestionDim::class, 'acte_gestion_dim_id');
    }
}
