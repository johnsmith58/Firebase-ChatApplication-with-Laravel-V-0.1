<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
class ChatController extends Controller
{

    public function chat(Request $request, $receive_id){
        $user = \Auth::user();
        $users = \App\User::get()->all();
        for($i = count($users)-1; $i >= 0; $i--){
            if($users[$i]->id == $user->id){
                unset($users[$i]);
            }
        }
        Javascript::put(['auth_user' => $user, 'receive_id' => $receive_id, 'users' => $users ]);
        return view('home', compact('users'));
    }
}
