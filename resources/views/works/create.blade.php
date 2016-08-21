<script>
var files = {!! json_encode($files) !!};
</script>

@extends('layouts.app')

@section('title')
    Add New Work
@endsection

@section('content')
    <form action="/work/new" method="post">
        <input type="hidden" class="token" name="_token" value="{{ csrf_token()}}" />
        <div class="form-item">
            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name="title" class="form-item-title" />
        </div>
        <div class="form-item">
            <textarea name='body' class="form-item-body ckeditor">{{ old('body') }}</textarea>
        </div>
        <div class="form-item">
            <div class="dropzone" id="upload-widget"></div>
        </div>
        <div class="form-item-hidden">
            <input type="text" name="files" />
        </div>
        <input type="submit" name='publish' class="button button-submit" value = "Publish"/>
        <input type="submit" name='save' class="button button-draft" value="Save Draft" />
    </form>
@endsection

@section('assets')
    <script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
    <script src="//code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="/js/vendor/dropzone.js"></script>
    <link href="/css/vendor/dropzone.css" rel="stylesheet"></link>
@endsection
