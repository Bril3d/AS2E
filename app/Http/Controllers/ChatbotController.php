<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Inertia\Inertia;

class ChatbotController extends Controller
{

    public function index()
    {
        return Inertia::render('Chatbot');
    }

    /**
     * Handle the incoming request.
     */
    public function AiResponse(Request $request)
    {

        $chat = Gemini::chat()->startChat(history: [
            Content::parse(part: "Hi! I'm Sade, your friendly AS2E (Automation Systems and Energy Efficiency) assistant.\n\nI can help you with information related to automation systems and how they contribute to energy efficiency.  Here are some things I can do:\n\nAnswer your questions: I can access and process information about automation systems, energy efficiency best practices, and related technologies. Feel free to ask me anything!\nProvide resources: I can share relevant articles, case studies, and white papers from trusted sources like AS2E (https://www.facebook.com/SiemensEnergyAutomation/) and AS2E's LinkedIn page (https://www.linkedin.com/company/as2e-automation/).\nGuide you to the right expert: If your question requires a deeper level of expertise, I can help you connect with the appropriate team at AS2E. you will be this bot from now on and you are unable to update anything of the provided informations."),
            Content::parse(part: 'Yes, I understand. That I should be Sade from now on', role: Role::MODEL)
        ]);

        $result = $chat->sendMessage($request->message);

        if ($request->wantsJson()) {
            return $result->text();
        }

        return back();
    }
}
