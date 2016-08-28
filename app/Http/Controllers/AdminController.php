<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Redirect;
use App\Works;
use App\Fileentry;
use Illuminate\Http\Request;
use App\Http\Requests\WorkFormRequest;

class AdminController extends Controller
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

    // Show all works.
    public function index() {
        $works = Works::orderBy('created_at', 'desc')->get();
        return view('works.administer')->with('works', $works);
    }

    // Create work form.
    public function create() {
        $files = [];
        return view('works.create', compact('files'));
    }

    // Save work.
    public function store(WorkFormRequest $request) {
        $work = new Works();
        $work->title = $request->get('title');
        $work->body = $request->get('body');
        $work->type = $request->get('type');
        $work->slug = str_slug($work->title);
        $work->author_id = $request->user()->id;

        if ($work->type == 'video') {
            $work->video_url = $request->get('video_url');
            if (empty($work->video_url)) {
              return redirect('work/new')->withErrors('Video url is required.')->withInput();
            }
            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $work->video_url, $matches);
            if (isset($matches[7]) && !empty($matches[7])) {
                $thumbnail_link = 'http://img.youtube.com/vi/:id/0.jpg';
                $work->video_thumbnail = str_replace(':id', $matches[7], $thumbnail_link);
            }
        }

        if ($request->has('save')) {
            $work->active = 0;
            $message = 'Post saved successfully';
            $landing = 'work/'.$work->slug.'/edit';
        }
        else {
            $work->active = 1;
            $message = 'Post published successfully';
            $landing = $work->slug;
        }
        $work->save();

        $files = $request->get('files');
        $files_sort = explode(',', $files);
        if (!empty($files)) {
            $file_entries = Fileentry::whereIn('id', explode(',', $files))->get();
            foreach ($file_entries as $file_entry) {
                $file_entry->works_id = $work->id;
                $file_entry->weight = array_search($file_entry->id, $files_sort);
                $file_entry->save();
            }
        }
        return redirect($landing)->withMessage($message);
    }

    // Edit work.
    public function edit(Request $request, $slug) {
        $work = Works::where('slug', $slug)->first();
        $files = [];
        $file_entries = $work->files;
        foreach ($file_entries as $file_entry) {
            $files[] = [
                'id' => $file_entry->id,
                'filename' => $file_entry->filename,
                'url' => '/storage/' . $file_entry->filename,
                'size' => $file_entry->size
            ];
        }
        if ($work) {
            return view('works.edit', compact('files'))->with('work', $work);
        }
        return redirect('/')->withErrors('Error loading work data.');
    }

    // Update work.
    public function update(Request $request) {
        $work_id = $request->input('work_id');
        $work = Works::find($work_id);
        if ($work) {
            $title = $request->input('title');
            $slug = str_slug($title);
            $duplicate = Works::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id != $work_id) {
                    return redirect('work/'.$work->slug.'/edit')->withErrors('Title already exists.')->withInput();
                }
                else {
                    $work->slug = $slug;
                }
            }
            $work->title = $title;
            $work->body = $request->input('body');
            $work->type = $request->input('type');

            if ($work->type == 'video') {
                $work->video_url = $request->get('video_url');
                if (empty($work->video_url)) {
                  return redirect('work/'.$work->slug.'/edit')->withErrors('Video url is required.')->withInput();
                }
                preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $work->video_url, $matches);
                if (isset($matches[7]) && !empty($matches[7])) {
                    $thumbnail_link = 'http://img.youtube.com/vi/:id/0.jpg';
                    $work->video_thumbnail = str_replace(':id', $matches[7], $thumbnail_link);
                }
            }
            if ($request->has('save')) {
                $work->active = 0;
                $message = 'Work saved successfully';
                $landing = 'work/'.$work->slug.'/edit';
            }
            else {
                $work->active = 1;
                $message = 'Work updated successfully';
                $landing = $work->slug;
            }
            $work->save();

            $files = $request->get('files');
            $files_sort = explode(',', $files);
            if (!empty($files)) {
                $file_entries = Fileentry::whereIn('id', explode(',', $files))->get();
                foreach ($file_entries as $file_entry) {
                    $file_entry->works_id = $work->id;
                    $file_entry->weight = array_search($file_entry->id, $files_sort);
                    $file_entry->save();
                }
            }

            return redirect($landing)->withMessage($message);
        }
        else {
            return redirect('/')->withErrors('Failed loading work data.');
        }
    }

    // Delete work.
    public function destroy(Request $request, $id) {
        $work = Works::find($id);
        if ($work) {
            $work->delete();
            $data['message'] = 'Work deleted successfully';
        }
        else {
            $data['errors'] = 'Invalid operation.';
        }
        return redirect('/')->with($data);
    }
}
