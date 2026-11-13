<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // 0-5 comments on every published post (pinned one is handled below)
        $posts = Post::where('is_published', true)->where('is_pinned', false)->get();

        foreach ($posts as $post) {
            Comment::factory()
                ->count(rand(0, 5))
                ->sequence(fn () => ['user_id' => $users->random()->id])
                ->create(['post_id' => $post->id]);
        }

        // pinned post: 3 comments, one by Lola
        $pinned = Post::where('is_pinned', true)->first();
        $lola = User::where('email', 'lola.valeroso@bulletin.test')->first();

        $pinned->comments()->create([
            'user_id' => $lola->id,
            'body'    => 'Happy to be there!',
        ]);

        Comment::factory()
            ->count(2)
            ->sequence(fn () => ['user_id' => $users->random()->id])
            ->create(['post_id' => $pinned->id]);
    }
}
