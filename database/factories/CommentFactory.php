<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = Post::first();
        if (!$post) {
            $post = Post::factory()->create();
        }

        return [
            'commenter_name' => $this->faker->text($this->faker->numberBetween(5, 100)),
            'content' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'post_id' => $this->faker->word,
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
