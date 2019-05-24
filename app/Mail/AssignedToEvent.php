<?php

namespace GoFunCrm\Mail;

use GoFunCrm\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignedToEvent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $event ;


    public function __construct(Event $event)
    {
        $this->event = $event ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->markdown('emails.events')->with([
        	'type' => $this->event->event_type,
        	'notes' => $this->event->notes,
        	'id' => $this->event->id,
        ]);
    }
}
