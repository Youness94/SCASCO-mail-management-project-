<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branche extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    // public function productions()
    // {
    //     return $this->hasMany(Production::class);
    // }
    public function productions()
{
    return $this->belongsToMany(Production::class, 'branche_production', 'branche_id', 'production_id');
}
}
