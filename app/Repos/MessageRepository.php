<?php  

namespace App\Repos;

use Illuminate\Http\Request;

use App\Conversation;

use App\Message;

use App\Mail\MessageResponse;

use App\Classes\ConversationToken;

use Illuminate\Support\Facades\Mail;


class MessageRepository implements MessageRepositoryInterface
{
	
	public function storeMessage(Request $request)
	{
		$conversation = Conversation::where('email', request('email'))->get()->first();
	
		if ($conversation !== null) {

			$conversation->opened = NULL;

			$conversation->save();

			Message::create([

				'owner' => 0,
				'body' => request('body'),
				'conversation_id' => $conversation->id

			]);

		} else {
			
			$newConversation = Conversation::create([

				'sender' => request('sender'),
				'email' => request('email'),
				'subject' => request('subject'),
				'token' =>	(new ConversationToken(26))

			]);

			Message::create([

				'owner' => 0,
				'body' => request('body'),
				'conversation_id' => $newConversation->id

			]);

		}
	}

	public function deleteConversation($conversationId)
	{
		Conversation::destroy($conversationId);
	}

	public function respond(Request $request)
	{
		Message::create([

			'owner' => 1,
			'body' => $request->response,
			'conversation_id' => $request->conversationId

		]);

		$conversation = Conversation::findOrFail($request->conversationId);		
		$conversation->opened = 1;
		$conversation->save();

		$conversation = Conversation::findOrFail($request->conversationId);
		$sender = $conversation->sender;
		$subject = $conversation->subject;
		$conversationToken = $conversation->token;

		Mail::to(request('to'))->send(new MessageResponse($request->conversationId, $conversationToken, $sender, $subject));
	}

	public function showConversation($conversation_id)
	{	

		return Conversation::with('messages')->find($conversation_id);

	}

	public function updateOpenedStatus($conversation_id)
	{
		$conversation = Conversation::find($conversation_id);
		$conversation->opened = 1;
		$conversation->save();

	}

	public function conversationsTotal()
	{

		return Conversation::count();

	}

	public function conversationsUnread()
	{

		return Conversation::where('opened', null)->count();

	}

	public function getPaginatedConversations($limit)
	{

		return Conversation::paginate($limit);

	}

	public function getConversationToken($conversationId)
	{

		return Conversation::find($conversationId)->token;

	}
}


?>