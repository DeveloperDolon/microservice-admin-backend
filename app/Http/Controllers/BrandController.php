<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Jobs\BrandCreateJob;
use App\Jobs\BrandDeleteJob;
use App\Jobs\BrandUpdateJob;
use App\Models\Brand;

class BrandController extends BaseController
{
    public function create(BrandRequest $request)
    {
        $brandData = $request->validated();

        $brand = new Brand();
        $brand->name = $brandData['name'];
        $brand->description = $brandData['description'];
        $brand->location = $brandData['location'];
        $brand->title = $brandData['title'];

        if ($request->hasFile('logo')) {
            $brand->logo = upload_image($request->file('logo'));
        }

        if ($request->hasFile('banner')) {
            $brand->banner = upload_image($request->file('banner'));
        }

        $brand->save();
        BrandCreateJob::dispatch($brand->toArray())->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse($brand, 'Brand created successfully.');
    }

    public function update(BrandRequest $request)
    {
        $brandData = $request->validated();
        $brand = Brand::findOrFail($request->id);

        $brand->name = $brandData['name'] ?? $brand->name;
        $brand->description = $brandData['description'] ?? $brand->description;
        $brand->location = $brandData['location'] ?? $brand->location;
        $brand->title = $brandData['title'] ?? $brand->title;

        if ($request->hasFile('logo')) {
            $brand->logo = upload_image($request->file('logo'));
        }

        if ($request->hasFile('banner')) {
            $brand->banner = upload_image($request->file('banner'));
        }

        $brand->save();
        BrandUpdateJob::dispatch($brand->toArray())->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse($brand, 'Brand updated successfully.');
    }

    public function delete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        BrandDeleteJob::dispatch($id)->onConnection('rabbitmq')->onQueue('main_queue');
        return $this->sendSuccessResponse([], 'Brand deleted successfully.');
    }

    public function list()
    {
        $brands = Brand::all();
        return $this->sendSuccessResponse($brands, 'Brand list retrieved successfully.');
    }

    public function show($id) 
    {
        $brand = Brand::findOrFail($id);
        return $this->sendSuccessResponse($brand, 'Brand details retrieved successfully.');
    }
}
