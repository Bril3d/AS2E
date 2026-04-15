<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use App\Models\Setting;
use Inertia\Inertia;

class ChatbotController extends Controller
{

    public function index()
    {
        $settings = json_decode(setting('chatbot_settings') ?? json_encode(Setting::getHomeDefaults('chatbot_settings')), true);
        
        return Inertia::render('Chatbot', [
            'botSettings' => $settings
        ]);
    }

    /**
     * Handle the incoming request.
     */
    public function AiResponse(Request $request)
    {
        $settings = json_decode(setting('chatbot_settings') ?? json_encode(Setting::getHomeDefaults('chatbot_settings')), true);

        $client = Gemini::getFacadeRoot();

        // If a custom API key is provided, create a new client
        if (!empty($settings['api_key'])) {
            $client = \Gemini::client($settings['api_key']);
        }

        $model = $settings['model'] ?? 'gemini-3-flash';
        
        $chat = $client->withModel($model)->chat()->startChat(history: [
            Content::parse(part: $settings['system_prompt']),
            Content::parse(part: 'Yes, I understand.', role: Role::MODEL)
        ]);

        $result = $chat->sendMessage($request->message);

        if ($request->wantsJson()) {
            return $result->text();
        }

        return back();
    }
}
