<?php

namespace App\Models;

use Pusher\Pusher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    // Relacion uno a muchos(inversa)
    public function escape()
    {

        return $this->belongsTo(Escape::class);
    }


    // Relacion uno a muchos
    public function users()
    {

        return $this->hasMany(User::class);
    }

    public function createPusherChannel()
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'encrypted' => true
        ]);
        $channelName = 'room-' . $this->id;
        $pusher->trigger($channelName, 'room-created', ['room_id' => $this->id]);
    }
}
