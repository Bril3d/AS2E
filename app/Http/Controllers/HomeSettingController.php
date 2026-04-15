<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HomeSettingController extends Controller
{
    public function index()
    {
        $keys = [
            'home_hero',
            'home_carousel',
            'home_features',
            'home_services',
            'home_stats',
            'home_faq',
            'chatbot_settings'
        ];

        $settings = [];
        foreach ($keys as $key) {
            $value = setting($key);
            $settings[$key] = $value ? json_decode($value, true) : Setting::getHomeDefaults($key);
        }

        return Inertia::render('HomeSettings', [
            'settings' => $settings
        ]);
    }

    public function updateHero(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
        ]);

        $this->save('home_hero', $data);

        return back()->with('success', 'Hero section updated.');
    }

    public function uploadHeroImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('hero', 'public');
        
        $carousel = json_decode(setting('home_carousel') ?? json_encode(Setting::getHomeDefaults('home_carousel')), true);
        $carousel[] = $path;

        $this->save('home_carousel', $carousel);

        return back()->with('success', 'Hero image uploaded.');
    }

    public function deleteHeroImage($index)
    {
        $carousel = json_decode(setting('home_carousel') ?? json_encode(Setting::getHomeDefaults('home_carousel')), true);
        
        if (isset($carousel[$index])) {
            $path = $carousel[$index];
            if (!str_starts_with($path, 'http')) {
                Storage::disk('public')->delete($path);
            }
            array_splice($carousel, $index, 1);
            $this->save('home_carousel', $carousel);
        }

        return back()->with('success', 'Hero image deleted.');
    }

    public function updateFeatures(Request $request)
    {
        $data = $request->validate([
            'section_title' => 'required|string',
            'section_caption' => 'required|string',
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'description' => 'required|string',
            'items' => 'required|array',
            'image' => 'nullable|image|max:2048',
        ]);

        $features = json_decode(setting('home_features') ?? json_encode(Setting::getHomeDefaults('home_features')), true);
        
        if ($request->hasFile('image')) {
            if (isset($features['image']) && !str_starts_with($features['image'], 'http')) {
                Storage::disk('public')->delete($features['image']);
            }
            $features['image'] = $request->file('image')->store('features', 'public');
        }

        $features['section_title'] = $data['section_title'];
        $features['section_caption'] = $data['section_caption'];
        $features['title'] = $data['title'];
        $features['subtitle'] = $data['subtitle'];
        $features['description'] = $data['description'];
        $features['items'] = $data['items'];

        $this->save('home_features', $features);

        return back()->with('success', 'Features updated.');
    }

    public function updateServices(Request $request)
    {
        $data = $request->validate([
            'section_title' => 'required|string',
            'section_caption' => 'required|string',
            'main_title' => 'required|string',
            'description' => 'required|string',
            'items' => 'required|array',
        ]);

        $this->save('home_services', $data);

        return back()->with('success', 'Services updated.');
    }

    public function updateStats(Request $request)
    {
        $data = $request->validate([
            'section_title' => 'required|string',
            'section_caption' => 'required|string',
            'items' => 'required|array',
        ]);

        $this->save('home_stats', $data);

        return back()->with('success', 'Stats updated.');
    }

    public function updateFaq(Request $request)
    {
        $data = $request->validate([
            'section_title' => 'required|string',
            'section_caption' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'items' => 'required|array',
        ]);

        $this->save('home_faq', $data);

        return back()->with('success', 'FAQ updated.');
    }

    public function updateChatbot(Request $request)
    {
        $data = $request->validate([
            'bot_name' => 'required|string',
            'welcome_message' => 'required|string',
            'system_prompt' => 'required|string',
            'api_key' => 'nullable|string',
            'model' => 'required|string',
        ]);

        $this->save('chatbot_settings', $data);

        return back()->with('success', 'Chatbot settings updated.');
    }

    protected function save($key, $value)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => json_encode($value)]
        );
        Cache::flush();
    }
}
