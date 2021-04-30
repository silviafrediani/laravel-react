<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\MailNotifyAdminPostCreated;


class NotifyAdminPostCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
      //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
			$admins = User::whereHas('roles', function (Builder $query) {
				$query->where('name', '=', 'admin');
			})->get();

			foreach ($admins as $admin) {
				Mail::to($admin->email)->send(new MailNotifyAdminPostCreated($event->post));
			}    
		}
}
