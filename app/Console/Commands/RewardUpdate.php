<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Traits\PostCommentTrait;
use Illuminate\Console\Command;

class RewardUpdate extends Command
{
    use PostCommentTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reward:update {post}';

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
        $post->update(['winner' => $post->lastPostComment->user_id]);
        $this->storeEndTime($post_id);



        $this->info('reward:update Command Run successfully!');
    }
}
