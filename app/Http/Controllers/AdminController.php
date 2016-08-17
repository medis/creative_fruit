<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Redirect;
use App\Works;
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

    // Create work form.
    public function create() {
        return view('works.create');
    }

    // Save work.
    public function store(WorkFormRequest $request) {
        $work = new Works();
        $work->title = $request->get('title');
        $work->body = $request->get('body');
        $work->slug = str_slug($work->title);
        $work->author_id = $request->user()->id;
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
        return redirect($landing)->withMessage($message);
    }

    // Edit work.
    public function edit(Request $request, $slug) {
        $work = Works::where('slug', $slug)->first();
        if ($work) {
            return view('works.edit')->with('work', $work);
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
                    return redirect('work/'.$post->slug.'/edit')->withErrors('Title already exists.')->withInput();
                }
                else {
                    $work->slug = $slug;
                }
            }
            $work->title = $title;
            $work->body = $request->input('body');
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