<?php

namespace App\Http\Controllers;

use App\Models\Clue;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return Clue::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $clue = new Clue();
      $request->validate([
        'clue'=> 'required',

      ]);

      $clue->clue = $request->clue;

      $clue->save();

      return $clue;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function show(Clue $clue, $id)
    {
      $clue = Clue::find($id);
      return $clue;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clue $clue, $id)
    {
      $clue = Clue::find($id);
      $request->validate([
        'clu'=> 'required',

      ]);

      $clue->clue = $request->clue;

      $clue->update();

      return $clue;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clue  $clue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clue $clue, $id)
    {
      $clue = Clue::find($id);

      $clue->delete();
    }


    }
