<?php

namespace App\Http\Middleware;

use App\Http\Resources\UserResource;
use App\Models\Expertise;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Setting;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {

        $request->user() ? $request->user()->load(['roles', 'permissions']) : null;

        return [
            ...parent::share($request),
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'success' => fn () => $request->session()->get('success'),
            ],
            'settings' => fn () => [
                'app_name' => json_decode(setting('general_settings'), true)['app_name'] ?? Setting::getHomeDefaults('general_settings')['app_name'],
                'contact_email' => json_decode(setting('general_settings'), true)['contact_email'] ?? Setting::getHomeDefaults('general_settings')['contact_email'],
                'date_format' => setting('date_format') ?: 'Y-m-d',
                'logo' => setting('logo'),
            ],
            'auth.user' => fn () => $request->user()
                ? new UserResource($request->user())
                : null,
            'auth.roles' => fn () => $request->user() ? $request->user()->roles->pluck('name') : [],
            'auth.permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            'expertises' => Expertise::select('title','slug')->get(),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'csrf_token' => csrf_token()
        ];
    }
}
