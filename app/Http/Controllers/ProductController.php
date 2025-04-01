<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProductCreateJob;
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
}
