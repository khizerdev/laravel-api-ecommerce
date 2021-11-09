<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::with('subcategory')->get();
        return $categories;
    }
}