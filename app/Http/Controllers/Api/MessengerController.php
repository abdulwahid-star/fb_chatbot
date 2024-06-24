<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use pimax\FbBotApp;
use pimax\Messages\message;

class MessengerController extends Controller
{
    public function webhook(Request $request) {
        $challenge = $request->input('hub_challenge');
        $verifyToken = $request->input('hub_verify_token');
        if ($verifyToken == env('PAGE_ACCESS_TOKEN')) {
            return response($challenge, 200);
        }
        
        return response('Forbidden', 403);
    }
}
