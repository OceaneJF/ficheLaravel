<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class fetchPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws ConnectionException
     */
    public function handle()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->get('https://jsonplaceholder.typicode.com/posts');
        if ($response->successful()) {
            $tab = $response->json();
            foreach ($tab as $post) {
                Post::create([
                    'titre' => $post['title'],
                    'body' => $post['body'],
                ]);
            }

        }
    }
}
