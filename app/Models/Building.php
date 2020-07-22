<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'img', 'electricity',
    ];

    public function recipes()
    {
        return $this->hasMany("App\Models\Recipe");
    }

    public function electricityUnites()
    {
        return $this->hasMany('App\Models\ElectricityUnite');
    }

    public function productionUnite()
    {
        return $this->belongsTo('App\Models\ProductionUnite');
    }
}
