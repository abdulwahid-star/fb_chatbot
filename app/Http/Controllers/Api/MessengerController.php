<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use pimax\FbBotApp;
use pimax\Messages\message;
use Illuminate\Support\Facades\Log;

class MessengerController extends Controller
{
    public function webhook(Request $request) {
        Log::info('Webhook requests received', ['request' => $request->all()]);

        $challenge = $request->input('hub_challenge');
        $verifyToken = $request->input('hub_verify_token');
        $mode = $request->input('hub_mode');

        if ($mode && $verifyToken) {
            if ($mode === 'subscribe' && $verifyToken === env('Verify_Token')) {
                return response($challenge, 200);
            } else {
                return response('Forbidden', 403);
            }
        }

        return response('Bad Request', 400);
    }
}
