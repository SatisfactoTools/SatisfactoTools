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
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductionBloc $productionBloc)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductionBloc  $productionBloc
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductionBloc $productionBloc)
    {
        //
    }
}
