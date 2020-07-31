<?php

namespace App\Http\Controllers;

use App\Models\ProductionBloc;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductionBlocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductionBloc::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $game = Game::findOrFail($request->game_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => "Game not found"
            ], 404);
        }

        $productionBloc = ProductionBloc::create([
            'game_id' => $request->game_id,
            'name' => $request->name
        ]);

        $productionBloc->save();

        return $productionBloc;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return \Illuminate\Http\Response
     */
    public function show(ProductionBloc $productionBloc)
    {
        return $productionBloc;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductionBloc  $productionBloc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductionBloc $productionBloc)
    {
        try {
            $game = Game::findOrFail($request->game_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => "Game not found"
            ], 404);
        }

        $productionBloc->game_id = $request->game_id;
        $productionBloc->name = $request->name;
        $productionBloc->save();

        return response()->json([
            'message' => "Production bloc successfully updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionBloc $productionBloc)
    {
        $productionBloc->delete();

        return response()->json([
            'message' => "Production bloc successfully deleted"
        ]);
    }

    public function connect(ProductionBloc $productionBloc, ProductionBloc $pdToConnect)
    {
        $pdToConnect->parent_id = $productionBloc->id;
        $pdToConnect->save();

        return response()->json([
            'message' => "Production blocs successfully connected"
        ]);
    }

    public function showChildren(ProductionBloc $productionBloc)
    {
        return $productionBloc->children;
    }

    public function showParent(ProductionBloc $productionBloc)
    {
        return $productionBloc->parent;
    }

    public function showProductionUnites(ProductionBloc $productionBloc)
    {
        return $productionBloc->productionUnites;
    }
}
