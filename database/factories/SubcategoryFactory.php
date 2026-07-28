<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Str;

class SubcategoryFactory extends Factory {
    protected $model = Subcategory::class;
    public function definition() {
        $name = $this->faker->words(2, true);
        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(4),
            'description' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
