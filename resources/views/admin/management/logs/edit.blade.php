@extends('layouts.admin')

@section('page_title')

Log

@endsection

@section('content')

<h1>Edit Log Entry</h1>

	<div class = "row">
		<div class = "col-sm-3">

			<a href="{{asset('images/' . $log->document_path) }}" data-sub-html="Demo Description">
               <img class="img-responsive" src="{{asset('images/' . $log->document_path) }}" alt="" class="img-responsive" width="200">
            </a>

		</div>

		<div class = "col-sm-9">

			{!! Form::model($log,['method'=>'PATCH', 'action'=>['AdminLogsController@update', $log->id],'files' => true]) !!}

				<div class = "form-group">
					{!! Form:: label('reference_no', 'Reference No:') !!}
					{!! Form:: text('reference_no',null, ['class'=>'form-control']) !!}
				</div>
				
				<div class = "form-group">
					{!! Form:: label('date_received', 'Date Received:') !!}
					{!! Form:: date('date_received',\Carbon\Carbon::now(), ['class'=>'form-control datepicker']) !!}
				</div>

				<div class = "form-group">
					{!! Form:: label('document_type_id', 'Document Type:') !!}
					{!! Form:: select('document_type_id', [''=>'Choose Options'] + $documents ,null, ['class'=>'form-control']) !!}
				</div>

				<div class = "form-group">
					{!! Form:: label('client_id', 'Client:') !!}
					{!! Form:: select('client_id', [''=>'Choose Options'] + $clients ,null, ['class'=>'form-control']) !!}

				</div>

				<div class = "form-group">
					{!! Form:: label('received_from', 'Received From:') !!}
					{!! Form:: text('received_from',null, ['class'=>'form-control']) !!}
				</div>

				{!! Form:: hidden('user_id', Auth::user()->id) !!}

				<div class = "form-group">
					{!! Form:: label('document_path', 'Document:') !!}
					{!! Form:: file('document_path',null, ['class'=>'form-control']) !!}

				</div>

				<div class = "form-group">
					<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
					{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
				</div>
				
				{!! Form::close() !!}

				@include('includes.form_error')

	</div>

@stop