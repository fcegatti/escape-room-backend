<?php

namespace App\Http\Controllers;

use App\Models\Escape;
use App\Models\Room;
use Illuminate\Http\Request;

class EscapeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escapes = Escape::with(['problems', 'rooms'])->get();

        return response()->json(['success' => true, "escape" => $escapes], 200);
    }


    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'time' => 'required',
            'rooms_amount' => 'required'
        ]);

        try {
            $escape = new Escape();
            $escape->title = $request->title;
            $escape->status = $request->status;
            $escape->time = $request->time;
            $escape->rooms_amount = $request->rooms_amount;
            $escape->save();

            return response()->json(['success' => true, 'message' => 'Escape created successfully', "escape" => $escape], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error creating escape: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Escape  $escape
     * @return \Illuminate\Http\Response
     */
    public function show(Escape $escape)
    {
        return $escape;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Escape  $escape
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Escape $escape)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'time' => 'required',
            'init_time' => 'required',
            'stage' => 'required',
        ]);

        $escape->title = $request->title;
        $escape->status = $request->status;
        $escape->time = $request->time;
        $escape->init_time = $request->init_time;
        $escape->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Escape  $escape
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escape $escape)
    {
        $escape->delete();
        return response()->json('delete sucess', 204);
    }
}
