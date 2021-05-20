<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AddFilesToArchive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file_path;
    private $index;
    private $archive_name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($archive_name, $file_path, $idx)
    {
        # initializing private variables
        $this->file_path = $file_path;          // name of each file to be added to archive
        $this->index = $idx;                    // identify the index if 0 create otherwise open
        $this->archive_name = $archive_name;    // name of the zip file name
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $zip = new \ZipArchive();
        $zip_file = Storage::disk('public')->path($this->archive_name); // Name of our archive to be sent to user through email
        if ($this->index === 0) {
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        } else {
            $zip->open($zip_file);
        }
        $zip->addFile(Storage::disk('public')->path($this->file_path), $this->file_path);
        $zip->close();
    }
}
