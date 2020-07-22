<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingRecipe extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'building_id',
    ];

    public function building()
    {
        return $this->belongsTo("App\Models\Building");
    }

    public function recipe()
    {
        return $this->belongsTo("App\Models\Recipe");
    }
}
