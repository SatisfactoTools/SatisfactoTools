<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function recipeResources()
    {
        return $this->hasMany('App\Models\RecipeResource');
    }

    public function buildings()
    {
        return $this->hasMany("App\Models\Building");
    }

    public function productionUnite()
    {
        return $this->belongsTo('App\Models\ProductionUnite');
    }
}
