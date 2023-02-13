<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Problem::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $problem = new Problem();
      $request->validate([
        'statement'=> 'required',
        'solution'=> 'required',

      ]);

      $problem->statement = $request->statement;
      $problem->solution = $request->solution;

      $problem->save();

      return $problem;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem, $id)
    {
      $problem = Problem::find($id);
      return $problem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem, $id)
    {
      $problem = Problem::find($id);
      $request->validate([
        'statement'=> 'required',
        'solution'=> 'required',

      ]);

      $problem->statement = $request->statement;
      $problem->solution = $request->solution;

      $problem->update();

      return $problem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem, $id)
    {
      $problem = Problem::find($id);
      
      $problem->delete();
    }
}
