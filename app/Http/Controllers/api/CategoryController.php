<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryController extends BaseController
{
    //

    public function index(Request $request) {
        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }

       $categories = Category::all();
       return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully.');
    }

    public function show(Request $request, $id) {
        $user = $this->authenticate($request);

        if (!$user) {
            return $this->sendError(
                'Unauthorised.',
                401
            );
        }
        $category = Category::where('id', $id)->first();

        if(!$category) {
            return $this->sendError('Category not found', [], 404);
        }
        return $this->sendResponse($category->toArray(), 'Category retrieved successfully.');
    }
}
