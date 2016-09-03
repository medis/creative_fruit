@extends('layouts.app')

@section('content')
    @if (!$works->count())
        <p>There are no works.</p>
    @else
        <div class="work-wrapper">
            <div class="masonry">
                @foreach ($works as $work)
                    @if (count($work->files) || $work->type == 'video')
                        <a href="{{ $work->slug }}" class="grid-item">
                            <div class="background"></div>
                            <div class="text-wrapper">
                              <h3>{{ $work->title }}</h3>
                              <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </div>
                            @if (count($work->files))
                                <img src="/storage/{{ $work->files->first()->filename }}" alt="{{ $work->title }}" />
                            @else
                                <img src="{{ $work->video_thumbnail }}" alt="{{ $work->title }}" />
                            @endif
                        </a>
                          @if(!Auth::guest())
                              @if($work->active == '1')
                                  <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Work</a></button>
                              @else
                                  <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Draft</a></button>
                              @endif
                          @endif
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection
