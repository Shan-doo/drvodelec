<?php  

namespace App\Repos;

use Illuminate\Http\Request;

use App\Subscriber;

use Illuminate\Support\Facades\Mail;

use App\Repos\SubscriberRepositoryInterface;


class SubscriberRepository implements SubscriberRepositoryInterface
{
	public function index()
	{
		return Subscriber::all();
	}

	public function subscribe($email)
	{	

		Subscriber::create([
		
		'email' => $email

		]);
		
	}

	public function subscribeAdmin($id)
	{	

		$subscriber = Subscriber::find($id);

		$subscriber->status = 1;

		$subscriber->save();
				
	}

	public function unsubscribe($id)
	{	
		$subscriber = Subscriber::find($id);

		$subscriber->status = 0;

		$subscriber->save();

	}

	public function destroy($subscriberId)
	{

		Subscriber::destroy($subscriberId);
	}

	public function getPaginatedSubscribers($limit)
	{
		return Subscriber::orderBy('email')->paginate($limit);

	}

	public function subscribersTotal()
	{

		return Subscriber::count();
	}

	public function subscribersActive()
	{

		return Subscriber::where('status', 1)->count();
	}

	public function subscribersInactive()
	{

		return Subscriber::where('status', 0)->count();
	}
}


?>