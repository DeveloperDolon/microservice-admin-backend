<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProductCreateJob;
use App\Jobs\ProductDeleteJob;
use App\Jobs\ProductUpdateJob;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        $productList = Product::paginate(request()->limit);

        if ($productList->isEmpty()) {
            return $this->sendErrorResponse('No products found.', 404);
        }
        return $this->sendSuccessResponse($productList, 'Products retrieved successfully.');
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->sendErrorResponse('Product not found.', 404);
        }
        return $this->sendSuccessResponse($product, 'Product retrieved successfully.');
    }

    public function create(ProductRequest $request)
    {
        $productData = $request->validated();

        $product = new Product();

        $product->name = $productData['name'];

        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $uploadedImages[] = upload_image($image);
            }
            $product->images = implode(',', $uploadedImages);
        }

        $product->discount = $productData['discount'];
        $product->price = $productData['price'];
        $product->description = $productData['description'];
        $product->discount_type = $productData['discount_type'];
        $product->ingredients = $productData['ingredients'];
        $product->shipping_cost = $productData['shipping_cost'];
        $product->benefit = $productData['benefit'];
        $product->seller_id = request()->user()->id;
        $product->brand_id = $productData['brand_id'];
        $product->save();

        $variants = json_decode($productData['variants']);

        if ($variants && count($variants) > 0) {
            foreach ($variants as $key => $variant) {
                $product->variants()->create((array)$variant);
            }
        }

        $product->load('variants');
        $productArray = $product->toArray();
        $productArray['variants'] = $product->variants->toArray();
        ProductCreateJob::dispatch($productArray)->onConnection('rabbitmq')->onQueue('main_queue');

        return $this->sendSuccessResponse($productArray, 'Product created successfully.');
    }

    public function update(Request $request, $id)
    {
        $productData = $request;

        $product = Product::find($id);
        $product->name = $productData['name'] ?? $product->name;
        $product->discount = $productData['discount'] ?? $product->discount;
        $product->price = $productData['price'] ?? $product->price;
        $product->description = $productData['description'] ?? $product->description;
        $product->discount_type = $productData['discount_type'] ?? $product->discount_type;
        $product->likes = $productData['likes'] ?? $product->likes;
        $product->ingredients = $productData['ingredients'] ?? $product->ingredients;
        $product->shipping_cost = $productData['shipping_cost'] ?? $product->shipping_cost;
        $product->benefit = $productData['benefit'] ?? $product->benefit;
        $product->brand_id = $productData['brand_id'] ?? $product->brand_id;
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $uploadedImages[] = upload_image($image);
            }
            $product->images = implode(',', $uploadedImages);
        }
        $product->save();

        if (isset($productData['variant_name']) && isset($productData['variant_ids']) && isset($productData['variant_price']) && isset($productData['variant_stock'])) {
            foreach ($productData['variant_name'] as $key => $variantName) {
                if (!empty($variantName)) {
                    if (isset($productData['variant_ids'][$key]) && $productData['variant_ids'][$key] != null) {
                        $isVariantExist = Variant::find($productData['variant_ids'][$key]);
                        $isVariantExist->name = $variantName;
                        $isVariantExist->stock = $productData['variant_stock'][$key];
                        $isVariantExist->price = $productData['variant_price'][$key];
                        $isVariantExist->save();
                    } else {
                        $product->variants()->create([
                            'name' => $variantName,
                            'stock' => $productData['variant_stock'][$key],
                            'price' => $productData['variant_price'][$key],
                        ]);
                    }
                }
            }
        }
        $product->load('variants');
        $productArray = $product->toArray();
        $productArray['variants'] = $product->variants->toArray();
        ProductUpdateJob::dispatch($productArray)->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse($product, 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return $this->sendErrorResponse('Product not found.', 404);
        }
        $product->delete();
        ProductDeleteJob::dispatch($id)->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse([], 'Product deleted successfully.');
    }
}
