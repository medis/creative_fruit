@extends('layouts.app')

@section('content')
    @if (!$works->count())
        <p>There are no works.</p>
    @else
        <div class="work-wrapper">
            <div class="masonry">
                @foreach ($works as $work)
                    @if (count($work->files))
                        <div class="grid-item">
                            <!--<h3><a href="{{ url('/'.$work->slug) }}">{{ $work->title }}</a>
                            </h3>
                            -->
                                <a href="{{ $work->slug }}"><img src="/storage/{{ $work->files->first()->filename }}" alt="{{ $work->title }}" /></a>
                                @if(!Auth::guest())
                                    @if($work->active == '1')
                                        <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Work</a></button>
                                    @else
                                        <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Draft</a></button>
                                    @endif
                                @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection
