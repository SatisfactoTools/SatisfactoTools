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
        return $this->belongsTo('App\Models\ProductionUnite');
    }
}
