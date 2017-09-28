@extends('layouts.admin')

@section('page_title')

Team

@endsection

@section('content')

<h1>Create Team</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminTeamsController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Name:') !!}
		{!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>
	

	<div class = "form-group">
		{!! Form:: label('team_leader', 'Team Leader:') !!}<br>
		{{Form::select('team_leader',$team_leaders,null,['class'=>'chosen-select form-control'],array('name'=>'team_leader'))}}
	</div>


	<div class = "form-group">
		{!! Form:: label('user_id', 'Employees:') !!}<br>

		
		<select name="user_id[]" class="chosen-select form-control" multiple="true">
		@if($users)
		@foreach($users as $user)
		@if(!$user->isManager())
			<option value="{{$user->id}}">{{$user->name}}</option>
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