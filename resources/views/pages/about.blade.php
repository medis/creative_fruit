@extends('layouts.app')

@section('title')
  About
@endsection

@section('title_meta')
  @if (!Auth::guest())
      <a href="{{ route('page_edit', 'About') }}">Edit</a>
  @endif
@endsection

@section('content')
  {!! $about->body !!}
@endsection
