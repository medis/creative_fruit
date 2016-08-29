<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Works;
use App\Fileentry;
use Auth;

class WorkController extends Controller
{
    // Home page callback.
    public function index() {
        $works = Works::where('active', 1)->orderBy('created_at', 'desc')->get();
        return view('home', ['works' => $works]);
    }

    // Show work page.
    public function show($slug) {
        $work = Works::where('slug', $slug)->first();
        if (!$work || (!Auth::check() && !$work->active)) {
            return redirect('/')->withErrors('Requested page not found');
        }

        $params = [];
        if ($work->type == 'video') {
            preg_match('/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/', $work->video_url, $matches);
            if (isset($matches[7]) && !empty($matches[7])) {
                $params['video_id'] = $matches[7];
            }
        }

        return view('works.show', $params)->with('work', $work);
    }

    // Works page.
    public function works() {
        $works = Works::where('active', 1)->where('type', 'work')->orderBy('created_at', 'desc')->get();
        return view('home', ['works' => $works]);
    }

    // Videos page.
    public function videos() {
        $videos = Works::where('active', 1)->where('type', 'video')->orderBy('created_at', 'desc')->get();
        return view('home', ['works' => $videos]);
    }
}
