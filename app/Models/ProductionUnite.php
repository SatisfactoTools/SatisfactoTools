<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionUnite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'production_bloc_id', 'building_id', 'name',
    ];

    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe');
    }

    public function productionBloc()
    {
        return $this->belongsTo('App\Models\ProductionBloc');
    }

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }
}
