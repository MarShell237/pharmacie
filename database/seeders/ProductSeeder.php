<?php

namespace Database\Seeders;

use App\Models\Batche;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::inRandomOrder()->limit(8)->pluck('id');
        $batches = Batche::inRandomOrder()->limit(8)->pluck('id');
        $products = Product::factory()
                    ->count(122)
                    ->make()
                    ->each(function ($product) use ($categories, $batches) {
                        $product->category_id = $categories->random();
                        $product->batche_id = $batches->random();
                    });
        foreach ($products as $product) {
            $path = public_path($product->image);
            if (file_exists($path)) {
                $uploadedFile = new UploadedFile(
                    $path,
                    basename($path),                        // nom original
                    mime_content_type($path),              // type mime
                    null,                                  // size (null = auto)
                    true                                   // test mode
                );

                $product->setFile($uploadedFile, 'products');
            }
            $product->save();
        }
    }
}
