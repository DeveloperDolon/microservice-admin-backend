<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Jobs\BrandCreateJob;
use App\Jobs\TestJob;
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
}
