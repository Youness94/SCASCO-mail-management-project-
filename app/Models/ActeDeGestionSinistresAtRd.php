<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActeDeGestionSinistresAtRd extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'acte_de_gestion_sinistres_at_rd';

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
    public function sinistres()
    {
        return $this->belongsToMany(Sinistre::class);
    }
}
