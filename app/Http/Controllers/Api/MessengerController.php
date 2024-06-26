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
        response()->json([
            'message' => $request->all()
        ]);

        $data = $request->all();

        if ($data['object'] === 'page') {
            foreach ($data['entry'] as $entry) {
                foreach ($entry['changes'] as $change) {
                    if ($change['field'] === 'comments' && $change['value']['item'] === 'comment') {
                        $commentId = $change['value']['comment_id'];
                        $pagepostId = $change['value']['page_post_id']; // Use page_post_id instead of post_id
                        $message = 'Thank you for your comment!'; // Your reply message

                        $this->replyToComment($pagepostId, $commentId, $message);
                    }
                }
            }

            return response('EVENT_RECEIVED', 200);
        }

        return response('Bad Request', 400);
    }

    private function replyToComment($pagepostId, $commentId, $message)
    {
        $url = "https://graph.facebook.com/v20.0/{$pagepostId}/comments";
        $params = [
            'message' => $message,
            'access_token' => env('PAGE_ACCESS_TOKEN'),
        ];

        $response = Http::post($url, $params);

        if ($response->failed()) {
            Log::error('Failed to send reply', ['response' => $response->body()]);
        }
    }
}
