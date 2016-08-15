<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    // About page callback.
    public function about() {
        return 'About';
    }

    // Contact page callback.
    public function contact() {
        return 'Contact';
    }

    public function login() {
      return view('auth/login');
    }
}
