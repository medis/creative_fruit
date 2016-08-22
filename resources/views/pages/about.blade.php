@extends('layouts.app')

@section('title_meta')
  @if (!Auth::guest())
      <a href="{{ route('page_edit', 'About') }}">Edit</a>
  @endif
@endsection

@section('content')
  <div class="header">
    <img src="/images/about_img.png" alt="" />
    <div class="text inner-container">
      <h2>Design is not just what it looks like,<br/>feels like, design is how it works.</h2>
      <div class="author"> - Steve Jobs -</div>
    </div>
  </div>
  <article class="inner-container">
    {!! $about->body !!}
  </article>
@endsection
