<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Pages;

class PageController extends Controller
{
    // About page callback.
    public function about() {
        $about = Pages::where('title', 'About')->first();
        if (empty($about)) {
          return redirect('/')->withErrors('Requested page not found');
        }
        return view('pages.about')->with('about', $about);
    }

    // Contact page callback.
    public function contact() {
        $contact = Pages::where('title', 'Contact')->first();
        if (empty($contact)) {
          return redirect('/')->withErrors('Requested page not found');
        }
        return view('pages.contact')->with('contact', $contact);
    }

    public function login() {
      return view('auth/login');
    }

    // Get Page edit form.
    public function edit($title) {
        $page = Pages::where('title', $title)->first();
        if (empty($page)) {
          return redirect('/')->withErrors('Requested page not found');
        }
        return view('pages.edit')->with('page', $page);
    }

    // Update Page.
    public function update(Request $request, $title) {
      $page = Pages::where('title', $title)->first();
      if (empty($page)) {
        return redirect('/')->withErrors('Requested page not found');
      }

      $page->body = $request->get('body');
      $page->save();
      return redirect('/' . strtolower($title));
    }
}
