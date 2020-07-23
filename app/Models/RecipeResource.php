<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeResource extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'resource_id', 'quantity',
    ];

    public function recipe()
    {
        return $this->belongsTo("App\Models\Recipe");
    }

    public function resource()
    {
        return $this->belongsTo("App\Models\Resource");
    }
}
