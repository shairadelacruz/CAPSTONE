@extends('layouts.admin')

@section('page_title')

Team

@endsection

@section('content')

<h1>Edit Team</h1>

	{!! Form::model($team,['method'=>'PATCH', 'action'=>['AdminTeamsController@update', $team->id]]) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Name:') !!}
		{!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>
	

	<div class = "form-group">
		{!! Form:: label('team_leader', 'Team Leader:') !!}<br>
		{!! Form:: select('team_leader', [''=>'Choose Options'] + $team_leaders ,$team->team_leader, ['class'=>'form-control chosen-select']) !!}
	</div>


	<div class = "form-group">
		{!! Form:: label('user_id', 'Employees:') !!}<br>
		<ul>
			@foreach($team->users as $user)
			<li>{{$user->name}}</li>
			@endforeach
		</ul>

		{!! Form:: label('user_id', 'Employees:') !!}<br>

		{!! Form:: select('user_id[]', [''=>'Choose Options'] + $users ,$team->users->first()->name, ['class'=>'form-control chosen-select', 'multiple'=>'multiple']) !!}
	</div>

	<div class = "form-group">
		<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop