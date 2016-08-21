@extends('layouts.app')

@section('title')
    Edit {{ $page->title }}
@endsection

@section('content')
    <form method="post" action='{{ url("/edit/" . $page->title) }}'>
        <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
        <div class="form-item">
            <textarea name='body' class="form-item-body ckeditor">@if (!old('body')){!! $page->body !!}@endif{!! old('body') !!}</textarea>
        </div>
        <input type="submit" name='save' class="button button-save" value="Update" />
    </form>
@endsection

@section('assets')
    <script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
@endsection
