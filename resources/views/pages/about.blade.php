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
  <div class="clearfix"></div>
  <article class="inner-container">
    <div class="about-icon"><img src="/images/about_icon.png" alt="" /></div>
    <h3 class="section-title biography"><span>Biography</span></h3>
    {!! $about->body !!}
    <div class="about-icon"><img src="/images/Skills_icon.png" alt="" /></div>
    <h3 class="section-title skills"><span>Skills</span></h3>
    <img src="/images/Skills.png" alt="" class="skills-image" />
    <div class="recent-work"><img src="/images/Work_icon.png" alt="" /></div>
    <h3 class="section-title recent-work"><span>Recent Work</span></h3>
  </article>
@endsection
