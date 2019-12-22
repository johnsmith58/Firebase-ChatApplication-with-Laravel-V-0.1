<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
class ChatController extends Controller
{
    public function index(Request $request, $auth_id, $receive_id){
        $user = \Auth::user();
        Javascript::put(['auth_id' => $auth_id, 'receive_id' => $receive_id ]);
        return view('chat.index');
    }
}
