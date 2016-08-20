<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Works;
use App\Fileentry;

class WorkController extends Controller
{
    // Home page callback.
    public function index() {
        $works = Works::orderBy('created_at', 'desc')->get();
        return view('home', ['works' => $works]);
    }

    // Show work page.
    public function show($slug) {
        $work = Works::where('slug', $slug)->first();
        if (!$work) {
            return redirect('/')->withErrors('Requested page not found');
        }

        return view('works.show')->with('work', $work);
    }
}
