<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionBloc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id', 'name',
    ];

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    public function productionUnites()
    {
        return $this->hasMany('App\Models\ProductionUnite');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\ProductionBloc', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\ProductionBloc', 'parent_id');
    }
}
