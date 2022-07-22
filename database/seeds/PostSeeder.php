<?php

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 150; $i++) {
            $post = new Post;
            $post->title = $faker->words(rand(2, 4), true);
            $post->slug = Post::getSlug($post->title);
            $post->image = 'https://picsum.photos/id/' .rand(1, 300) . '/500/300';
            $post->content = $faker->paragraphs(rand(2, 10), true);
            $post->excerpt = $faker->paragraph();
            $post->save();
    }
}
}
