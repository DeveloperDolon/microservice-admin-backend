<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProductCreateJob;
use App\Jobs\ProductUpdateJob;
use App\Models\Product;

class ProductController extends BaseController
{
    public function index()
    {
        $productList = Product::all();
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
        $product->likes = $productData['likes'];
        $product->ingredients = $productData['ingredients'];
        $product->shipping_cost = $productData['shipping_cost'];
        $product->benefit = $productData['benefit'];
        $product->seller_id = $productData['seller_id'];
        $product->brand_id = $productData['brand_id'];
        $product->save();
        
        ProductCreateJob::dispatch($product->toArray())->onConnection('rabbitmq')->onQueue('main_queue');
        
        return $this->sendSuccessResponse($product, 'Product created successfully.');
    }

    public function update(ProductRequest $request, $id) 
    {
        $productData = $request->validated();
        
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
        $product->seller_id = $productData['seller_id'] ?? $product->seller_id;
        $product->brand_id = $productData['brand_id'] ?? $product->brand_id;
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $uploadedImages[] = upload_image($image);
            }
            $product->images = implode(',', $uploadedImages);
        }
        $product->save();
        
        ProductUpdateJob::dispatch($product->toArray())->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse($product, 'Product updated successfully.');
    }
}
