<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'img', 'resource_type_id',
    ];

    public function resourceType()
    {
        return $this->belongsTo("App\Models\ResourceType");
    }

    public function recipeResources()
    {
        return $this->hasMany('App\Models\RecipeResource');
    }
}
