<?php  

namespace App\Repos;

use Illuminate\Http\Request;

use App\Conversation;


interface MessageRepositoryInterface
{

	public function storeMessage(Request $request);

	public function deleteConversation($conversationId);

	public function respond(Request $request);

	public function showConversation($conversation_id);

	public function updateOpenedStatus($conversation_id);

	public function conversationsTotal();

	public function conversationsUnread();

	public function getPaginatedConversations($limit);


}

?>