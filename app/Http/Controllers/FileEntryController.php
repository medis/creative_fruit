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

        $file = Input::file('file');

        $destinationPath = 'storage'; // upload path
        $raw_filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $raw_filename = preg_replace('/\.'.$extension.'/', '', $raw_filename);
        $fileName = $raw_filename . '_' . time() . '.' . $extension; // renameing image
        $size = $file->getClientSize();
        $upload_success = $file->move($destinationPath, $fileName); // uploading file to given path
        $file_entry = new Fileentry();
        $file_entry->filename = $fileName;
        $file_entry->size = $size;
        $file_entry->mime = $file->getClientMimeType();
        $file_entry->original_filename = $raw_filename . '.' . $extension;
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
            $file = Fileentry::find($id);
            $filename = $file->filename;
            $file->delete();
            \File::delete('storage/'. $filename);
            return Response::json('success', 200);
        }
        return Response::json('error', 400);
    }
}
