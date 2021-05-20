<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\SendArchiveToUser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendArchive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $packet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($packet)
    {
        // initialize variables
        $this->packet = $packet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $email = new SendArchiveToUser($this->packet);
            Mail::to($this->packet['to_email'])->send($email);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
