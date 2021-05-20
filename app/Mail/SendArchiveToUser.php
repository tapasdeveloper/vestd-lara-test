<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendArchiveToUser extends Mailable
{
    use Queueable, SerializesModels;

    private $packet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($packet)
    {
        $this->packet = $packet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Download your archive')
            ->view('emails.DownloadArchiveEmail')
            ->with('packet', $this->packet);
    }
}
