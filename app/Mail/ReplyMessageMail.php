<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReplyMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public $subject;
    public $msgContent;

    public function __construct($subject, $msgContent)
    {
        $this->subject = $subject;
        $this->msgContent = $msgContent;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->html(nl2br(e($this->msgContent)));
    }
}
