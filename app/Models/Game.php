<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function productionBlocs()
    {
            return $this->hasMany('App\Models\ProductionBloc');
    }
}
