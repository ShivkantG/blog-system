<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    public function run(): void
    {

        
        $user = User::where('id', 2)->first();
        if ($user) {

            if (!Storage::disk('public')->exists('posts/sample.jpg')) {
                Storage::disk('public')->put(
                    'posts/sample.jpg',
                    file_get_contents(public_path('images/sample.jpg'))
                );
            }
            Post::create([
                'user_id' => $user->id,
                'title' => 'Second Demo Post',
                'slug' => Str::slug('Second Demo Post'),
                'content' => 'This is the content of the second demo post.',
                'image' => 'posts/sample.jpg',
            ]);
        }
        
        $user3 = User::where('id', 3)->first();
        if ($user3) {
            Post::create([
                'user_id' => $user3->id,
                'title' => 'User 3 First Post',
                'slug' => Str::slug('User 3 First Post'),
                'content' => 'This is the first post for user 3.',
                'image' => 'posts/sample.jpg',
            ]);

            Post::create([
                'user_id' => $user3->id,
                'title' => 'User 3 Second Post',
                'slug' => Str::slug('User 3 Second Post'),
                'content' => 'This is the second post for user 3.',
                'image' => 'posts/sample.jpg',
            ]);

            Post::create([
                'user_id' => $user3->id,
                'title' => 'User 3 Third Post',
                'slug' => Str::slug('User 3 Third Post'),
                'content' => 'This is the third post for user 3.',
                'image' => 'posts/sample.jpg',
            ]);
        }

    }
}
