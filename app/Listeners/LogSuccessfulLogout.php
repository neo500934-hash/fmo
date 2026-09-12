<?php

namespace App\Listeners;

use App\Models\UserActivity;
use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        $request = request();

        $event->user->update([
            'is_online' => false,
            'last_seen_at' => now(),
        ]);

        UserActivity::create([
            'user_id' => $event->user->id,
            'type' => 'logout',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}
