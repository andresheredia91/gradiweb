<?php

namespace App\Observers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WelcomeUserObserve
{
    /**
     * Handle the invitation "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Mail::to($user->email)->queue(new WelcomeEmail($user));
    }
}
