<?php

namespace App\Http\Controllers;

use App\Models\ProductionUnite;
use Illuminate\Http\Request;

class ProductionUniteController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productionUnite = ProductionUnite::create([
            'recipe_id' => $request->recipe_id,
            'building_id' => $request->building_id,
            'production_bloc_id' => $request->production_bloc_id,
            'name' => $request->name
        ]);

        $productionUnite->save();

        return $productionUnite;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionUnite $productionUnite)
    {
        return $productionUnite;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductionUnite $productionUnite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductionUnite $productionUnite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionUnite $productionUnite)
    {
        //
    }
}
