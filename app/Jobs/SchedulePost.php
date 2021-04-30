<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class SchedulePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
			//
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
			$posts = Post::where('post_status', 'scheduled')->where('date_scheduled', '<=', date('Y-m-d H:i:s', strtotime("now")))->get();
			foreach($posts as $post) {
				$post->update(
					[
						'post_status' => 'published',
					]
				);
			}		
    }
}
