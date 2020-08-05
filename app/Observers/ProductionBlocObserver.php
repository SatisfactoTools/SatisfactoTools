<?php

namespace App\Observers;

use App\Models\ProductionBloc;
use App\Models\Log;

class ProductionBlocObserver
{
    /**
     * Handle the production bloc "created" event.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return void
     */
    public function created(ProductionBloc $productionBloc)
    {
        Log::create([
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'created',
        ]);
    }

    /**
     * Handle the production bloc "updated" event.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return void
     */
    public function updated(ProductionBloc $productionBloc)
    {
        Log::create([
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'updated',
        ]);
    }

    /**
     * Handle the production bloc "deleted" event.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return void
     */
    public function deleted(ProductionBloc $productionBloc)
    {
        Log::create([
            'user_id' => $productionBloc->game->user->id,
            'table' => $productionBloc->getTable(),
            'action' => 'deleted',
        ]);
    }
}
