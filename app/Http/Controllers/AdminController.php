<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feed;

class AdminController extends Controller
{
    public function index()
    {	
    	$feeds = Feed::orderBy('created_at', 'desc')->get();
	
    	return view('admin.index', compact('feeds', 'last_login'));
    }
}
