<?php  

namespace App\Repos;

use Illuminate\Http\Request;

use App\Subscriber;


interface SubscriberRepositoryInterface
{

	public function index();

	public function subscribe($email);

	public function unsubscribe($id);

	public function destroy($subscriberId);

	public function getPaginatedSubscribers($limit);

}

?>