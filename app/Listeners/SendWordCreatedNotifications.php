<?php

namespace App\Listeners;

use App\Events\WordCreated;
use App\Models\User;
use App\Notifications\NewWord;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWordCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WordCreated $event): void
    {
        //
        foreach (User::whereNot('id', $event->word->user_id)->cursor() as $user) {

            $user->notify(new NewWord($event->word));

        }
    }
}
