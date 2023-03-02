<?php

namespace App\Http\Controllers;

use Pusher\Pusher;
use App\Models\Room;
use App\Models\Escape;
use App\Mail\YouCredentials;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            $escape->status = 'sin iniciar';
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'time' => 'sometimes|required',
            'rooms_amount' => 'sometimes|required'
        ]);

        try {
            $escape = Escape::findOrFail($id);

            if ($request->has('title')) {
                $escape->title = $request->title;
            }

            if ($request->has('time')) {
                $escape->time = $request->time;
            }

            if ($request->has('status')) {
                $escape->status = $request->status;
            }

            if ($request->has('rooms_amount')) {
                $escape->rooms_amount = $request->rooms_amount;
            }

            $escape->save();

            return response()->json(['success' => true, 'message' => 'Escape updated successfully', "escape" => $escape], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error updating escape: ' . $e->getMessage()]);
        }
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

    public function sendMessageToRoom(Request $request)
    {

        $user = JWTAuth::parseToken()->authenticate();

        echo $user->room->id;
        if (!$user->room) {
            // El usuario no está asociado a ninguna sala, devolver una respuesta de error
            return response()->json(['error' => 'El usuario no está asociado a ninguna sala.']);
        }

        // Si llegamos aquí, el usuario está asociado a una sala, podemos continuar con el envío del mensaje
        $message = $request->input('message');
        $room = $user->room->id;

        $data = [
            'user_id' => $user->id,
            'username' => $user->name,
            'message' => $message,
        ];

        // Crear una instancia de Pusher
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' => true
        ]);

        // Enviar el mensaje a la sala específica
        $channelName = 'room-' . $room;
        $pusher->trigger($channelName, 'message-received', $data);

        // Devolver una respuesta al cliente
        return response()->json(['success' => true]);
    }


    public function sendEmailsToUsers($escapeRoomId)
    {
        $escape = Escape::with('rooms.users')->find($escapeRoomId);

        // Obtener todos los usuarios de los cuartos de escape
        $users = $escape->rooms->flatMap(function ($room) {
            return $room->users;
        });

        // Enviar correo electrónico a cada usuario
        foreach ($users as $user) {
            Mail::to($user->email)->send(new YouCredentials($user->name));
        }

        return response()->json(['success' => true]);
    }
}
