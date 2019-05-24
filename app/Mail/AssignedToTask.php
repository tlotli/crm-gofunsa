<?php

namespace GoFunCrm\Mail;

use GoFunCrm\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignedToTask extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tasks')->with([
        	'notes' => $this->task->notes,
        ]);
    }
}
