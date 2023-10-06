<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeGestionDim extends Model
{
    use HasFactory;
    /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'acte_gestions_dim';

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
      return $this->belongsToMany(SinistreDim::class);
  }
}
