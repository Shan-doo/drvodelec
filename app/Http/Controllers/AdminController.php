<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Message;

use App\User;

class AdminController extends Controller
{
    public function index()
    {	
    	$messages = Message::take(5)->get();

    	$users = User::all();
	
    	return view('admin.index', compact('messages', 'users'));
    }
}
