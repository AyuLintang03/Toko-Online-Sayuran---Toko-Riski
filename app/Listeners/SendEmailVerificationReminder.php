<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmailReminder;

class SendEmailVerificationReminder implements ShouldQueue
{
    public function handle(Registered $event)
    {
        $user = $event->user;

        if (!$user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailReminder());
        }
    }
}

