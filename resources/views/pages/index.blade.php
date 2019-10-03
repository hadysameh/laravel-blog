@extends('layouts.app')


@section('content')

	<div class="jumbotron text-center">

		<h1>{{$title}}</h1>
		<p>this is the laravel application</p>
		<p>
			<a href="/login" class="btn btn-info">Login</a>

			<a href="/register" class="btn btn-success">Register</a>
			
		</p>
	</div>

@endsection