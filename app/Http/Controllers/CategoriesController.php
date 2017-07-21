<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoriesController extends Controller
{
    public function store(Request $request)
    {
    	Category::create(['name' => $request->category]);

    	return redirect()->back();
    }
}
