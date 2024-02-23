<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'filename' => $this->faker->word . '.jpg',
            'caption' => $this->faker->sentence,
            'path' => 'images',
            'imageable_type' => Product::class,
            'imageable_id' => Product::factory(), // You can also use an existing Post ID here

        ];
    }
}
