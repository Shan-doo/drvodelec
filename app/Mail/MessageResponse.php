<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $conversationId;

    public $conversationToken;

    public $sender;

    public $subject;

    public function __construct($conversationId, $conversationToken, $sender, $subject)
    {   

        $this->conversationId = $conversationId;

        $this->conversationToken = $conversationToken;

        $this->sender = $sender;

        $this->subject = $subject;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.response');
    }
}
