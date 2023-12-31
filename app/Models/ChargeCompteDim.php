<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargeCompteDim extends Model
{
    use HasFactory;
    /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'charges_comptes_dim';

  /**
   * The primary key for the model.
   *
   * @var string
   */
  protected $primaryKey = 'id';
  
  protected $guarded = [];
  public function user()
  {
      return $this->belongsTo(User::class);
  } 
  public function sinistres_dim()
  {
      return $this->belongsToMany(SinistreDim::class, 'sinistres_dim', 'acte_gestion_dim_id', 'charge_compte_dim_id')
      ->using(ActesGestionSinisterDimCategorie::class)
      ->withPivot(['categorie_id', 'sinistre_dim_id'])
      ->withTimestamps();
  }
}
