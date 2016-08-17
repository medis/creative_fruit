@extends('layouts.app')

@section('content')
    @if (!$works->count())
        <p>There are no works.</p>
    @else
        <div>
            @foreach ($works as $work)
                <div>
                    <h3><a href="{{ url('/'.$work->slug) }}">{{ $work->title }}</a>
                    @if(!Auth::guest())
                        @if($work->active == '1')
                            <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Work</a></button>
                        @else
                            <button class="btn" style="float: right"><a href="{{ url('work/'.$work->slug.'/edit')}}">Edit Draft</a></button>
                        @endif
                    @endif
                    </h3>
                    <div class="list-group-item">
                        ITEM
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
