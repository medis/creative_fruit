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
use App\Fileentry;

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
        $destinationPath = 'storage'; // upload path
        $extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        $fileName = Input::file('file')->getFilename() . '_' . time() . '.' . $extension; // renameing image
        $upload_success = Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
        $file_entry = new Fileentry();
        $file_entry->filename = $fileName;
        $file_entry->mime = Input::file('file')->getClientMimeType();
        $file_entry->original_filename = Input::file('file')->getFilename() . '.' . $extension;
        $file_entry->save();
        if ($upload_success) {
            return Response::json(['status' => 'success', 'id' => $file_entry->id], 200);
        } else {
            return Response::json(['status' => 'error'], 400);
        }
    }

    // Delete image.
    public function destroy() {
        $id = Input::get('id');
        if (!empty($id)) {
            Fileentry::destroy($id);
            return Response::json('success', 200);
        }
        return Response::json('error', 400);
    }
}
