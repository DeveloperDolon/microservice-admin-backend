<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Jobs\ProductCreateJob;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends BaseController
{
    //
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function create(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        ProductCreateJob::dispatch($product->toArray());

        return $this->sendSuccessResponse(
            $product,
            'Product created successfully.'
        );
    }
}
