@extends('layouts.app')

@section('content')

	<h1>Create Post</h1>
	 {{-- package from laravel collective --}}
	{!! Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data'])!!}
	{{--'action'=>'PostsController@store' where we are submitting to --}}
	{{-- 'enctype'=>'multipart/data' encrypt type --}}
	<div class="form-group">

		{{Form::label('title','Title')}}

		{{-- line 13 is <label name='title'>Title</label> --}}

		{{Form::text('title','',['class'=>'form-control','placeholder'=>'title'])}}
		
		{{-- this array contains attributes --}}
		{{-- <input name='title' value='' class=''></input> --}}
	</div>
    {{-- {!! Form::open(['url' => 'foo/bar']) !!} --}}
    <div class="form-group">

		{{Form::label('body','Body')}}

		{{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body text'])}}
	</div>
	<div class="form-group">
		{{form::file('cover_image')}}
		{{-- form::file('cover_image') creating file ,it's name is cover_image --}}
	</div>
	{{Form::submit('submit',['class'=>'btn btn-primary'])}}
    
	{!! Form::close() !!}
@endsection	