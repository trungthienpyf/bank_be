<?php

namespace App\Console;

use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $posts = Post::query()->with('lastPostComment')->whereNull('winner')->get();
        foreach ($posts as $post) {
            $guardTime = strtotime($post->created_at) + $post->timeSession;
            $noGuardTime = strtotime($post->created_at);
            if ($post->lastPostComment) {
                $getTime = $post->lastPostComment;

                $month = date('M', strtotime($getTime->created_at));
                $day = date('d', strtotime($getTime->created_at));

                if ($guardTime - 60 *5 <= strtotime($getTime->created_at) && $guardTime >= strtotime($getTime->created_at)) {


                    $time = date('H:i', strtotime($getTime->created_at) + (65 * 5));


                    $schedule->command('reward:update ' . $post->id)->yearlyOn($month, $day, $time);

                } else if ($guardTime <= time()) {
                    $time = date('H:i', $guardTime + 60);
                    $schedule->command('reward:update ' . $post->id)->yearlyOn($month, $day, $time);
                }


            }
            if (empty($post->lastPostComment)) {

                $month = date('M', $noGuardTime);
                $day = date('d', $noGuardTime);
                $time = date('H:i', $guardTime + 60);
                $schedule->command('noneReward:update ' . $post->id)->yearlyOn($month, $day, $time);

            }


        }

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
