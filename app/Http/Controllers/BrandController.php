<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends BaseController
{
    public function create(BrandRequest $request){
        $brandData = $request->validated();

        return $this->sendSuccessResponse($brandData, 'Brand data validated successfully.');

        $brand = Brand::create($request->validated());

        return $this->sendSuccessResponse($brand, 'Brand created successfully.');
    }
}
