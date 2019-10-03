@extends('layouts.app')

@section('content')
<br>
<a href="/posts" class="btn btn-info">Go Back</a>
	<h1>{{$post->title}}</h1>
	<img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
	<br><br>
	<div>
		{!!$post->body!!}
		{{-- this wierd syntax will turn html to be executed in the template --}}
	</div>
	<hr>
	<small>written on {{$post->created_at}}</small>
	<hr>
	@if(!Auth::guest())
		@if(Auth::user()->id == $post->user_id )
		{{-- line 15 means if the user is not a guest --}}
		<a href="/posts/{{$post->id}}/edit" class="btn btn-success">Edit</a>

		{!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
			{!!Form::hidden('_method','DELETE')!!}
			{!!Form::submit('Delete',['class'=>'btn btn-danger'])!!}
		{!!Form::close()!!}
		@endif
	@endif
@endsection