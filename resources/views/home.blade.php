@extends('layouts.app')

@section('title')
    {{$title}}
@endsection

@section('content')
    @if ( !$works->count() )
        <p>There are no works.</p>
    @else
    <div>
      @foreach( $works as $work )
      <div class="list-group">

          <h3><a href="{{ url('/'.$work->slug) }}">{{ $work->title }}</a>
            @if(!Auth::guest())
              @if($post->active == '1')
                <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Work</a></button>
              @else
                <button class="btn" style="float: right"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
              @endif
            @endif
          </h3>
          <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} By <a href="{{ url('/user/'.$post->author_id)}}">{{ $post->author->name }}</a></p>

        <div class="list-group-item">
          <article>
            {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}
          </article>
        </div>
      </div>
      @endforeach
      {!! $posts->render() !!}
    </div>
    @endif
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if (Auth::check())
                    <div class="panel-body">
                        You are logged in!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
