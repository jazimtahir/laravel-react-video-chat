<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {
        $socketId = $request->socket_id;
        $channelName = $request->channel_name;

        $pusher = new Pusher('33811f58dac5eadce2cb', '87efab65a31237f2b1f4', '1130683', [
            'cluster' => 'ap2',
            'encrypted' => true
        ]);

        $presence_data = ['name' => auth()->user()->name];
        $key = $pusher->presence_auth($channelName, $socketId, auth()->user()->id, $presence_data);

        return response($key);
    }
}
//pusher.com pevebar993@cocyo.com pusher4free