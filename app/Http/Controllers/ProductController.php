<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreateJob;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
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

    public function createProduct(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->image = $request->image;
        $product->save();

        ProductCreateJob::dispatch($product->toArray());

        return response()->json($product, Response::HTTP_CREATED);
    }
}
