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

		<select name="user_id[]" class="chosen-select form-control" multiple="true">

		@if($team->users)
		@foreach($team->users as $user)
		@if(!$user->isManager())
			<option selected="selected" value="{{$user->id}}">{{$user->name}}</option>
		@endif
		@endforeach
		@endif

		@if($users)
		@foreach($users as $user)
		@if(!$user->isTeamMember($team->id))
		@if(!$user->isManager())
			<option value="{{$user->id}}">{{$user->name}}</option>
		@endif
		@endif
		@endforeach
		@endif
		</select>
	</div>

	<div class = "form-group">
		<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop