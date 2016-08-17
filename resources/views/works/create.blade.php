@extends('layouts.app')

@section('title')
    Add New Work
@endsection

@section('content')
    <form action="/work/new" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token()}}" />
        <div class="form-item">
            <input required="required" value="{{ old('title') }}" placeholder="Enter title here" type="text" name="title" class="form-item-title" />
        </div>
        <div class="form-item">
            <textarea name='body' class="form-item-body">{{ old('body') }}</textarea>
        </div>
        <input type="submit" name='publish' class="button button-submit" value = "Publish"/>
        <input type="submit" name='save' class="button button-draft" value="Save Draft" />
    </form>
@endsection
