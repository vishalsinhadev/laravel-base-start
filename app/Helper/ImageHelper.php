<?php

namespace App\Helper;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ImageHelper
{

    static public function handle($limit = null, $category = null)
    {
        if (($category == null) || ($category == 'Product')) {
            $products = Product::whereNotNull('ProductLogo')->where([
                'is_image_optimized' => 0
            ]);

            if ($limit) {
                $products->limit($limit);
            }
            $products = $products->get();
            foreach ($products as $product) {
                DB::beginTransaction();
                try {
                    $imagPath = getBaseImageUrl("Product/{$product->ProductId}/{$product->ProductLogo}");
                    $imgExt = explode('.', $product->image_file);
                    $imgExt = end($imgExt);
                    $image = Image::make($imagPath)->resize(215, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                        ->encode($imgExt, 60);
                    $fileName = "Product/{$product->ProductId}/resize/{$product->ProductLogo}";
                    Storage::disk('s3')->put("$fileName", $image->stream());
                    print_r("\nIMG: " . $imagPath);
                    $product->update([
                        'is_image_optimized' => 1
                    ]);
                    DB::commit();
                } catch (\Exception $e) {
                    print_r($e->getMessage());
                    DB::rollBack();
                }
            }
        }
    }
}
