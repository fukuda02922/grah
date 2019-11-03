<?php

namespace App\Console\Commands;

use App\Post;
use Illuminate\Console\Command;

class ViewPostsTitle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:view {user?} {--userName=s}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New more post view title';

    protected $post;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        parent::__construct();
        $this->post = $post;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $posts = Post::latest('created_at')->first();
        $queueName = $this->option('userName');
        echo $queueName . " = " . $posts->title;

    }
}
