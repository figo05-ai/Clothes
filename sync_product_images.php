<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;

$directory = public_path('images/products');
if (!is_dir($directory)) {
    echo "Directory does not exist.\n";
    exit;
}

$files = scandir($directory);
$products = Product::all();

$updatedCount = 0;

foreach ($files as $file) {
    if (in_array($file, ['.', '..'])) continue;

    $filePath = '/images/products/' . $file;
    $filenameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
    
    // We try to find a product whose name matches the filename.
    // For example, filename: "essential-navy-t-shirts" matches product name "Essential Navy T-Shirts"
    $matchedProduct = $products->first(function ($product) use ($filenameWithoutExt) {
        return Str::slug($product->name) === Str::slug($filenameWithoutExt);
    });

    if ($matchedProduct) {
        ProductImage::updateOrCreate(
            ['product_id' => $matchedProduct->id, 'is_primary' => true],
            ['image_path' => $filePath, 'sort_order' => 1]
        );
        echo "Linked image {$file} to product: {$matchedProduct->name}\n";
        $updatedCount++;
    } else {
        echo "No matching product found for image: {$file}\n";
    }
}

echo "Successfully updated {$updatedCount} products!\n";
