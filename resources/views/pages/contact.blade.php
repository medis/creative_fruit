@extends('layouts.app')

@section('title')
  Contact
@endsection

@section('title_meta')
  @if (!Auth::guest())
      <a href="{{ route('page_edit', 'Contact') }}">Edit</a>
  @endif
@endsection

@section('content')
  <div class="inner-container">
    @if (!empty($contact->body))
      <div class="two-column">
    @else
      <div class="one-column">
    @endif
      <div class="text">{!! $contact->body !!}</div>
      <form id="contact-form" method="post" action='{{ route('contact_store') }}'>
          <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
          <div class="form-item">
              <i class="fa fa-smile-o"></i>
              <input required="required" placeholder="Enter your name" type="text" name="name" class="form-item-name" value="{{ old('name') }}"/>
          </div>
          <div class="form-item">
              <i class="fa fa-envelope"></i>
              <input required="required" placeholder="Enter your email" type="text" name="email" class="form-item-name" value="{{ old('email') }}"/>
          </div>
          <div class="form-item">
              <textarea placeholder="Enter your message" required="required" name='body' class="form-item-body">{!! old('body') !!}</textarea>
          </div>
          <div class="g-recaptcha" data-sitekey="6LfJnCgTAAAAALu92o_4EWUANs53jP4gZkqbvYH3"></div>
          <input type="submit" name='save' class="button button-save" value="Contact me!" />
      </form>
    </div>
  </div>
@endsection
