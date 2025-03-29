<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends BaseController
{
    public function create(BrandRequest $request){
        $brand = Brand::create($request->validated());

        return $this->sendSuccessResponse($brand, 'Brand created successfully.');
    }
}
