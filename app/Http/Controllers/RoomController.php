<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::with(['users'])->get();

        return response()->json(['success' => true, "escape" => $room], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $request->validate([
        'maxUsers'=> 'required',
        'init_time'=> 'required',
        'points'=> 'required',
        'escapes'=> 'required'
        ]);

        $room= new Room();
        $room->maxUsers = $request->maxUsers;
        $room->init_time = $request->init_time;
        $room->points = $request->points;

        $room->save();
        
        // buscame en la DB el escape, y asignale esta room 
        return $room;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return $room;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'maxUsers'=> 'required',
            'init_time'=> 'required',
            'points'=> 'required',
            ]);
    
            $room->maxUsers = $request->maxUsers;
            $room->init_time = $request->init_time;
            $room->points = $request->points;
    
            $room->update();
            return $room;
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
    }
}
