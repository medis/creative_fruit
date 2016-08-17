@extends('layouts.app')

@section('title')
    @if ($work)
        {{ $work->title }}
        @if (!Auth::guest())
            <button class="button button-edit"><a href="{{ url('/work/'.$work->slug.'/edit') }}">Edit Work</a></button>
        @endif
    @else
        <h2>Page does not exist</h2>
    @endif
@endsection


@section('content')
@if ($work)
    <div>
        {!! $work->body !!}
    </div>
@endif
@endsection
