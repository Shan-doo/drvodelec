<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Feed;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UpdateUser;



class UsersController extends Controller
{
    public function index(Request $request)
    {	
    	if ($request->ajax()) {
    		
    		return response()->json(['data' => User::all()]);
    	}

    	return view('admin.pages.users.index');
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

        return view('admin.pages.users.stats');
    }

    public function show(User $user)
    {	
        $feeds = $user->feeds()->orderBy('created_at', 'desc')->get();

    	return view('admin.pages.users.show', ['user' => $user, 'feeds' => $feeds]);
    }

    /*public function storeAvatar(Request $request)
    {   
        
        $user = User::find(Auth::user()->id);

        if ($user->avatar != null) {
            
            if (unlink(storage_path('app/public/avatars/' . $user->avatar))) {
                
                $imageName = $request->image->store('public/avatars/');

                list($imageName, $extension) = explode('.', substr($imageName, strripos($imageName, '/') + 1));

                $user->avatar = $imageName . '.' . $extension;

                $user->save();

            } else {

                return;
            }
        } else {

            $imageName = $request->image->store('public/avatars/');

            list($imageName, $extension) = explode('.', substr($imageName, strripos($imageName, '/') + 1));

            $user->avatar = $imageName . '.' . $extension;

            $user->save();
        }

        

        return $imageName . '.' . $extension;
    }*/

    public function update(User $user, UpdateUser $request)
    {   
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->new_password;
        $user->save();
    }

}
