@extends('layouts.app')

@section('content')

	<h1>Edit Post</h1>
	{!! Form::open(['action'=>['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data'])!!}

	<div class="form-group">

		{{Form::label('title','Title')}}

		{{-- line 13 is <label name='title'>Title</label> --}}

		{{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'title'])}}
		
		{{-- value is $post->title --}}
	</div>
    <div class="form-group">

		{{Form::label('body','Body')}}

		{{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body text'])}}
	</div>
	<div class="form-group">
		{{form::file('cover_image')}}
		{{-- form::file('cover_image') creating file ,it's name is cover_image --}}
	</div>
	{{Form::hidden('_method','PUT')}}
	{{-- this will make the method put because we can't make ot like that directly --}}
	{{Form::submit('submit',['class'=>'btn btn-primary'])}}
    
	{!! Form::close() !!}
@endsection	