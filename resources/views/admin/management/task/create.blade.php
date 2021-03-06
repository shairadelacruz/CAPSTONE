@extends('layouts.admin')

@section('page_title')

Assign Task

@endsection

@extends('includes.form_includes');

@section('content')

<h1>Create Task</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminTasksController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Task Name:') !!}
	    {!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('description', 'Description:') !!}
       	{!! Form:: textarea('description',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('client_id', 'Client:') !!}
		{!! Form:: select('client_id', [''=>'Choose Options'] + $clients ,null, ['class'=>'form-control chosen-select client']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('user_id', 'Accountant:') !!}
		{!! Form:: select('user_id', [''=>'Choose Options'] ,null, ['class'=>'form-control chosen-select accountant', 'id'=>'accountant']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('log_id', 'Document:') !!}
		{{Form::select('log_id[]',$logs,null,['class'=>'chosen-select form-control document', 'id'=>'document', 'multiple'=>'multiple'],array('reference_no'=>'log_id[]'))}}
	</div>

	<div class = "form-group">
		{!! Form:: label('deadline', 'Set Deadline:') !!}
		{!! Form:: date('deadline',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('task_type', 'Task types:') !!}
		{!! Form:: select('task_type', array(0=>'None/Other', 1=>'Journal', 2=>'Accounts Receivable', 3=>'Accounts Payable'), 0, ['class'=>'form-control show-tick']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('status', 'Status:') !!}
		{!! Form:: select('status', array(0=>'Pending', 1=>'Done', 2=>'For Quality Assurance', 3=>'For Revision'), 0, ['class'=>'form-control show-tick']) !!}
	</div>

	<div class = "form-group">
		<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}


	@include('includes.form_error')

	@section('scripts')

	<script>

		$('.client').on('change', function() {
  			var id = $('.client').val();
  			var dataId = {'id':id};

  			$.ajax({
	        type    : 'get',
	        url     : '/admin/management/task/create/findClient/'+id,
	        dataType: 'json',
	        data    : {'id':id},
	        success:function(data){

	        	$('#accountant').empty();  

   				$.each(data, function(key, value){
   
      				$('#accountant').append('<option value=' + value.id + '>'+value.name+'</option>');
      				$('.chosen-select').trigger("chosen:updated");
   				});

	        }
	       
	    	})

	    	$.ajax({
	        type    : 'get',
	        url     : '/admin/management/task/create/findDocument/'+id,
	        dataType: 'json',
	        data    : {'id':id},
	        success:function(data){

	        	$('#document').empty();  

   				$.each(data, function(key, value){
   
      				$('#document').append('<option value=' + value.id + '>'+value.reference_no+'</option>');
      				$('.chosen-select').trigger("chosen:updated");
   				});

	        }
	       
	    	});
	            
		});

		
		
	</script>

	@endsection

@stop