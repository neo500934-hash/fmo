<?php

namespace App\Listeners;

use App\Models\UserActivity;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $request = request();

        $event->user->update([
            'is_online' => true,
            'last_seen_at' => now(),
        ]);

        UserActivity::create([
            'user_id' => $event->user->id,
            'type' => 'login',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
