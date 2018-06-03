@extends('layouts.dashboard')

@section('content')
	<div class="well">
		<legend>
		Course Unit is successfully added.</legend>

		<legend>
			<a href="{{ URL::Route('add-course-unit')}}" class="btn btn-primary">Add new</a>
		</legend>
	</div>
@stop