<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Purok Valeroso', 'Urgent', 'Libre', 'Schedule', 'Other'];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }

        $tags = Tag::all();

        // 1-3 random tags per post, through the relationship
        foreach (Post::where('is_pinned', false)->get() as $post) {
            $post->tags()->sync($tags->random(rand(1, 3))->pluck('id'));
        }

        // pinned post always has exactly these two
        $pinned = Post::where('is_pinned', true)->first();
        $pinned->tags()->sync(
            Tag::whereIn('name', ['Purok Valeroso', 'Urgent'])->pluck('id')
        );
    }
}
