<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ManualSendEmailVerificationNotification extends SendEmailVerificationNotification implements ShouldQueue
{
    //
}
