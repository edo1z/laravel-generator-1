<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Author;
use App\Models\Category;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $category = Category::first();
        if (!$category) {
            $category = Category::factory()->create();
        }

        return [
            'title' => $this->faker->text($this->faker->numberBetween(5, 200)),
            'author_id' => $this->faker->word,
            'category_id' => $this->faker->word,
            'content' => $this->faker->text($this->faker->numberBetween(5, 4096)),
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
            'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
