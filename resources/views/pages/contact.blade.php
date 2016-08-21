@extends('layouts.app')

@section('title')
  Contact
@endsection

@section('title_meta')
  @if (!Auth::guest())
      <a href="{{ route('page_edit', 'Contact') }}">Edit</a>
  @endif
@endsection

@section('content')
  {!! $contact->body !!}
@endsection
