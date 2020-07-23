<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectricityUnite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'building_id', 'name',
    ];

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }
}
