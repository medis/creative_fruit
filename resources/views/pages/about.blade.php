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
  <div id="#animate-text-trigger"></div>
  <article class="about inner-container">
    <div class="about-icon"><img src="/images/about_icon.png" alt="" /></div>
    <h3 class="section-title biography"><span>Biography</span></h3>
    <div class="body">{!! $about->body !!}</div>
    <div class="about-icon"><img src="/images/Skills_icon.png" alt="" /></div>
    <h3 class="section-title skills"><span>Skills</span></h3>
    <img src="/images/Skills.png" alt="" class="skills-image" />
    <div class="recent-work"><img src="/images/Work_icon.png" alt="" /></div>
    <h3 class="section-title recent-work"><span>Recent Work</span></h3>
    @if ($works->count())
      <div class="recent-works carousel">
        @foreach ($works as $work)
          @if (count($work->files))
            <div class="slide-item">
              <a href="{{ $work->slug }}"><img src="/storage/{{ $work->files->first()->filename }}" alt="{{ $work->title }}" /></a>
            </div>
          @endif
        @endforeach
      </div>
    @endif
  </article>
@endsection

@section('assets')
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.0/plugins/animation.gsap.min.js"></script>
@endsection
