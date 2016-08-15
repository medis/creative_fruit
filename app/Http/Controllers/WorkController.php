<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Works;

class WorkController extends Controller
{
    // Home page callback.
    public function index() {
        $works = Works::where('active', 1)->orderBy('created_at', 'desc');
        return view('home', ['works' => $works]);
    }
}
