<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends BaseController
{
    public function show($id) 
    {

        $review = Review::find($id);

        return $this->sendSuccessResponse($review, 'Review retrieved successful!');
    }

    public function list()
    {
        $seller_id = request()->user()->id;

        $reviews = Review::whereHas('product', function ($query) use ($seller_id) {
            $query->where('seller_id', $seller_id);
        })->get();

        return $this->sendSuccessResponse($reviews, 'Reviews retrieved successfully!');
    }
}
