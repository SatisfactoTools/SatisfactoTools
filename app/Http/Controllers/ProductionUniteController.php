<?php

namespace App\Http\Controllers;

use App\Models\ProductionUnite;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Building;
use App\Models\ProductionBloc;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductionUnite $productionUnite)
    {
        try {
            $recipe = Recipe::findOrFail($request->recipe_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => "Recipe not found"
            ], 404);
        }

        try {
            $building = Building::findOrFail($request->building_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => "Building not found"
            ], 404);
        }

        try {
            $productionBloc = ProductionBloc::findOrFail($request->production_bloc_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => "Production Bloc not found"
            ], 404);
        }

        $productionUnite->recipe_id = $request->recipe_id;
        $productionUnite->building_id = $request->building_id;
        $productionUnite->production_bloc_id = $request->production_bloc_id;
        $productionUnite->name = $request->name;
        $productionUnite->save();

        return response()->json([
            'message' => "Production Unite successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductionUnite  $productionUnite
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionUnite $productionUnite)
    {
        $productionUnite->delete();

        return response()->json([
            'message' => 'Production Unite successfully deleted'
        ]);
    }
}
