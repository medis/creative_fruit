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
  <div id="animate-text-trigger"></div>
  <article class="about inner-container">
    <div class="about-icon"><img src="/images/about_icon.png" alt="" /></div>
    <div id="trigger-biography"></div>
    <h3 class="section-title biography">
      <div class="border left-border"></div>
      <div>Biography</div>
      <div class="border right-border"></div>
    </h3>
    <div class="body">{!! $about->body !!}</div>
    <div class="about-icon"><img src="/images/Skills_icon.png" alt="" /></div>
    @if (!empty($skills))
      <div id="trigger-skills"></div>
      <h3 class="section-title skills">
        <div class="border left-border"></div>
        <div>Skills</div>
        <div class="border right-border"></div>
      </h3>
      <div class="skills-wrapper">
        <ul>
          @foreach ($skills as $skill)
            <li class="skill-chart" id='{{ $skill->id }}' data-colors='{{ $skill->colors }}' data-percent='{{ $skill->percent }}' data-text='{{ $skill->text }}'></li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="recent-work"><img src="/images/Work_icon.png" alt="" /></div>
    <div id="trigger-work"></div>
    <h3 class="section-title recent-work">
      <div class="border left-border"></div>
      <div>Recent Work</div>
      <div class="border right-border"></div>
    </h3>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.min.js"></script>
@endsection
