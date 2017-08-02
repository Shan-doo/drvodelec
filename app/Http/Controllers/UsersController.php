<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request)
    {	
    	if ($request->ajax()) {
    		
    		return response()->json(['data' => User::all()]);
    	}

    	return view('admin.pages.users');
    }

    public function showStats(Request $request)
    {   
        /*if ($request->ajax()) {*/
            
            return ['data' => User::select(DB::raw('YEAR(created_at) as year, MONTHNAME(created_at) AS month, count(MONTHNAME(created_at)) AS number_of_users'))
                                /*->where(DB::raw('YEAR(created_at)'), $request->yearly)*/
                                ->groupBy(DB::raw('YEAR(created_at), MONTHNAME(created_at)'))
                                ->orderByRaw('min(created_at)')
                                ->get(), 

                        'years' => User::select(DB::raw('DISTINCT YEAR(created_at) as year'))->get()
                        ];
        /*}*/

        return view('admin.pages.users-stats');
    }

    public function show(User $user)
    {	
    	return view('admin.pages.user-show', ['user' => $user]);
    }
}
