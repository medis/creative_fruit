@extends('layouts.app')

@section('title')
    @if ($work)
        {{ $work->title }}
        @if (!Auth::guest())
            <a href="{{ url('/work/'.$work->slug.'/edit') }}">Edit Work</a>
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

    @foreach ($work->files as $file)
        <img src="/storage/{{ $file->filename }}" />
    @endforeach
@endif
@endsection
