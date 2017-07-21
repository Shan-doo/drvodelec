<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repos\SubscriberRepositoryInterface;

class SubscribersController extends Controller
{	
	protected $subscribersRepo;

	public function __construct(SubscriberRepositoryInterface $subscribersRepo)
	{
		$this->subscribersRepo = $subscribersRepo;
	}

    public function index(Request $request)
    {   
    	$subscribers = $this->subscribersRepo->getPaginatedSubscribers(10);

        $subscribersTotal = $this->subscribersRepo->SubscribersTotal();

        $subscribersActive = $this->subscribersRepo->SubscribersActive();

        $subscribersInactive = $this->subscribersRepo->SubscribersInactive();

        if ($request->ajax()) {

             return view('admin.partials.subscribers', 
                compact('subscribers', 'subscribersTotal', 'subscribersActive', 'subscribersInactive'));
        }

        return view('admin.pages.subscribers', 
                compact('subscribers', 'subscribersTotal', 'subscribersActive', 'subscribersInactive'));
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
