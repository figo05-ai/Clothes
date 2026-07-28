<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryFactory extends Factory {
    protected $model = Category::class;
    public function definition() {
        $name = $this->faker->words(2, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(4),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
