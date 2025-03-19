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
}
