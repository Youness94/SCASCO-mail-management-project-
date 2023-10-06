<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchSinistresAtRd extends Model
{
    use HasFactory;
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'branches_sinistres_at_rd';

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
