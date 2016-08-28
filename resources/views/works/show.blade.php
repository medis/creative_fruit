@extends('layouts.app')

@section('title')
    @if ($work)
        {{ $work->title }}
    @else
        <h2>Page does not exist</h2>
    @endif
@endsection
@section('title_meta')
  @if (!Auth::guest())
      <a href="{{ url('/work/'.$work->slug.'/edit') }}">Edit Work</a>
  @endif
@endsection

@section('content')
@if ($work)
    <div class="inner-container">
        @if (!$work->files->count() && $work->type == 'work')
          {!! $work->body !!}
        @else
          <div class="left">{!! $work->body !!}</div>
          <div class="right">
              @if ($work->type == 'video')
                  <div class="videoWrapper">
                      <iframe id="ytplayer" type="text/html" width="640" height="390" src="https://www.youtube.com/embed/{{ $video_id }}?autoplay=0" frameborder="0"></iframe>
                  </div>
              @endif

            @foreach ($work->files as $file)
                <img src="/storage/{{ $file->filename }}" />
            @endforeach
          </div>
        @endif
    </div>
@endif
@endsection
