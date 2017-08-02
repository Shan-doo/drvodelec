<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreMessage;

use App\Repos\MessageRepositoryInterface;


class MessageController extends Controller
{	

	public $messagesRepo;
	

	public function __construct(MessageRepositoryInterface $messagesRepo)
	{
		$this->messagesRepo = $messagesRepo;
	}

	public function index(Request $request)
	{	

		$conversationsTotal = $this->messagesRepo->conversationsTotal();

		$conversationsUnread = $this->messagesRepo->conversationsUnread();

		$conversations = $this->messagesRepo->getPaginatedConversations(5);
		

		if ($request->ajax()) {
			
			return view('admin.partials.messages', 
					compact('conversations', 'conversationsTotal', 'conversationsUnread'));

		}

		return view('admin.pages.messages', 
				compact('conversations', 'conversationsTotal', 'conversationsUnread'));

	}

	public function create()
	{
		return view('admin.pages.messages-create');
	}

	public function show($conversation_id)
	{	
		return $this->messagesRepo->showConversation($conversation_id);
	}

	public function store(StoreMessage $request)
	{	
		/*dd($request->all());*/
		$this->messagesRepo->storeMessage($request);

		return response()->json()
				->withCookie('email', $request->email)
				->withCookie('name', $request->sender)
				->withCookie('subject', $request->subject);
	}

	public function update($conversation_id)
	{
		$this->messagesRepo->updateOpenedStatus($conversation_id);
	}

	public function respond(Request $request)
	{	
		$this->messagesRepo->respond($request);	
	}

	public function delete($conversationId)
	{	
		$this->messagesRepo->deleteConversation($conversationId);
	}

}