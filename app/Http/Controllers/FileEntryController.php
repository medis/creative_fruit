<?php
//https://arjunphp.com/how-to-use-dropzone-js-laravel-5/
//https://maxoffsky.com/code-blog/uploading-files-in-laravel-4/
//https://www.codetutorial.io/laravel-5-file-upload-storage-download/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Validator;
use Response;

class FileEntryController extends Controller
{
    public function get($filename) {
        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
    }

    public function store() {
        $input = Input::all();
        $rules = array(
            'file' => 'image|max:3000',
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return Response::make($validation->errors->first(), 400);
        }
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        if ($upload_success) {
            return Response::json('success', 200);
        } else {
            return Response::json('error', 400);
        }
    }
}
