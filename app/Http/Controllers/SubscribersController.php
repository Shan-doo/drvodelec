<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repos\SubscriberRepositoryInterface;

use App\Subscriber;

use Illuminate\Support\Facades\DB;

class SubscribersController extends Controller
{	
	protected $subscribersRepo;

	public function __construct(SubscriberRepositoryInterface $subscribersRepo)
	{
		$this->subscribersRepo = $subscribersRepo;
	}

    public function index(Request $request)
    {   

        if ($request->ajax()) {

            return response()->json(['data' => Subscriber::all()]);
        }

        return view('admin.pages.subscribers'); 
                
    }

    public function showStats(Request $request)
    {   
        if ($request->ajax()) {

            if ($request->chart == 'bar') {
            
                return ['data' => Subscriber::select(DB::raw('YEAR(created_at) as year, MONTHNAME(created_at) AS month, count(MONTHNAME(created_at)) AS number_of_subscribers'))
                                /*->where(DB::raw('YEAR(created_at)'), $request->yearly)*/
                                ->groupBy(DB::raw('YEAR(created_at), MONTHNAME(created_at)'))
                                ->orderByRaw('min(created_at)')
                                ->get(), 

                        'years' => Subscriber::select(DB::raw('DISTINCT YEAR(created_at) as year'))->get()
                        ];
            }
        

        /*SELECT YEAR(created_at) AS year, MONTHNAME(created_at) AS month, count(MONTHNAME(created_at)) AS number_of_subscribers FROM subscribers GROUP BY year, month ORDER BY created_at*/

            if ($request->chart == 'pie') {
                
                return response()->json([
                    Subscriber::where('status', 1)->count(), 
                    Subscriber::where('status', 0)->count()
                ]);
            }

        }
        
        return view('admin.pages.subscribers-stats');
    }

	public function store(Request $request)
    {	

        if ($request->email) {

            $this->validate($request, [

            'email' => 'required|email|unique:subscribers,email',

            ]);

            return $this->subscribersRepo->subscribe($request->email);
        }

        if ($request->id) {

           $this->subscribersRepo->subscribeAdmin($request->id);
        }
    	
    }

    public function unsubscriber(Request $request)
    {
        $this->subscribersRepo->unsubscribe($request->id);
    } 

    public function destroy($subscriberId)
    {   
        $this->subscribersRepo->destroy($subscriberId);
    }   
}
