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
        $mode = $request->input('hub_mode');

        if ($mode && $verifyToken) {
            if ($mode === 'subscribe' && $verifyToken === env('PAGE_ACCESS_TOKEN')) {
                return response($challenge, 200);
            } else {
                return response('Forbidden', 403);
            }
        }

        return response('Bad Request', 400);
    }
}
