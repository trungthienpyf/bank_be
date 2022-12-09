<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class NoneRewardUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noneReward:update {post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $post_id = $this->argument('post');
        $post = Post::query()->where('id', $post_id)->first();
        $post->update(['winner' => 0]);
        $this->info('noneReward:update Command Run successfully!');
    }
}
