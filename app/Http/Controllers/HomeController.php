<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Jobs\SendArchive;
use Illuminate\Http\Request;
use App\Jobs\AddFilesToArchive;
use App\Mail\SendArchiveToUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * creation of archive of files
     */
    public function createArchive()
    {
        $packet = [];
        $user_id = auth()->user()->id;
        $archive_file_name = "user-{$user_id}-archive.zip";


        // get files to be added to archive
        $files = auth()->user()->getFileList();

        // send each file to job
        if (is_array($files) && count($files) > 0) {
            foreach ($files as $key => $file) {
                $this->dispatch(new AddFilesToArchive($archive_file_name, $file, $key));
            }
        }

        // creating email packet
        $packet['url'] = Storage::disk('public')->url($archive_file_name);
        $packet['to_name'] = auth()->user()->name;
        $packet['to_email'] = auth()->user()->email;

        // sending email to job
        $this->dispatch(new SendArchive($packet));

        Session::flash('message', 'Archive is processing. It will be sent to your email');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('home');
    }
}
