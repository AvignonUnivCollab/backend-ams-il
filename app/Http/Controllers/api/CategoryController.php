<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    //

    public function index() {
       $categories = Category::all();
       return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully.');
    }

    public function show($id) {
        $category = Category::where('id', $id)->first();

        if(!$category) {
            return $this->sendError('Category not found', [], 404);
        }
        return $this->sendResponse($category->toArray(), 'Category retrieved successfully.');
    }
}
