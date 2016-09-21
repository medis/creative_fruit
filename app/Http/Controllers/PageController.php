<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Pages;
use App\Works;
use App\Variable;
use App\Http\Requests\ContactFormRequest;

class PageController extends Controller
{
    // About page callback.
    public function about() {
        $about = Pages::where('title', 'About')->first();
        $works = Works::where('active', 1)->orderBy('created_at')->take(8)->get();

        if (empty($about)) {
          return redirect('/')->withErrors('Requested page not found');
        }

        $skills = json_decode(Variable::where('title', 'skills')->first()->data);
        return view('pages.about')->with('about', $about)->with('works', $works)->with('skills', $skills);
    }

    // Contact page callback.
    public function contact() {
        $contact = Pages::where('title', 'Contact')->first();
        if (empty($contact)) {
          return redirect('/')->withErrors('Requested page not found');
        }
        return view('pages.contact')->with('contact', $contact);
    }

    // Save contact entry.
    public function contactSave(ContactFormRequest $request) {
      $client = new \GuzzleHttp\Client();
      $res = $client->request('POST', 'https://www.google.com/recaptcha/api/siteverify', [
        'form_params' => [
          'secret' => env('CAPTCHA_SECRET'),
          'response' => $request->get('g-recaptcha-response'),
          'remoteip' => $request->ip()
        ]
      ]);
      $response = json_decode($res->getBody(), true);
      if (!$response['success']) {
        return redirect('contact')->withErrors('Error verifying captcha');
      }

      \Mail::send('emails.contact', [
        'name' => $request->get('name'),
        'email' => $request->get('email'),
        'user_message' => $request->get('body')
      ], function($message) {
          $message->from(env('EMAIL_ADDRESS_FROM'));
          $message->to(env('EMAIL_ADDRESS'))->subject('CreativeFruit Contact Form Submission');
      });

      return redirect('contact')->with('message', 'Thank you for contacting me!');
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
