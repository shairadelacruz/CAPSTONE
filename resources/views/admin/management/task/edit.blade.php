@extends('layouts.admin')

@section('page_title')

Assign Task

@endsection

@section('content')

<h1>Edit Task</h1>


{!! Form::model($task,['method'=>'PATCH', 'action'=>['AdminTasksController@update', $task->id]]) !!}

	{!! Form:: hidden('task', $task->id, ['class'=>'task']) !!}

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
		{!! Form:: select('user_id', [''=>'Choose Options'] + $users ,null, ['class'=>'form-control chosen-select accountant', 'id'=>'accountant']) !!}
	</div>


	<div class = "form-group">
		{!! Form:: label('log_id', 'Document:') !!}

		<select id="document" class="chosen-select form-control document" name="log_id[]" multiple="multiple" required="true">
			@foreach($task->log as $tasklog)
			<option value="{{$tasklog->id}}" selected="true">{{$tasklog->reference_no}}</option>
			@endforeach
			@if($logs)
			@foreach($logs as $log)
			<option value="{{$log->id}}">{{$log->reference_no}}</option>
			@endforeach
			@endif
		</select>
	</div>

	<div class = "form-group">
		{!! Form:: label('deadline', 'Set Deadline:') !!}
		{!! Form:: date('deadline',$task->deadline, ['class'=>'form-control datepicker']) !!}
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


	<div class="body">
		<a name="document_photos"></a>
    	<div id="aniimated-thumbnials" class="list-unstyled row clearfix">
    		@foreach($task->log as $log)
           <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
               <a href="{{asset('/images/' . $log->document_path) }}" data-sub-html="{{$log->reference_no}}">
                  <img class="img-responsive thumbnail" src="{{asset('/images/' . $log->document_path) }}">
                </a>                     
           </div>
           @endforeach
        </div>                  
   </div>

   	@section('scripts')

	<script>

		$('.client').on('change', function() {
			var task_id = $('.task').val();
  			var id = $('.client').val();
  			var dataId = {'id':id};

  			$.ajax({
	        type    : 'get',
	        url     : '/admin/management/task/'+ task_id +'/edit/findClient/'+id,
	        dataType: 'json',
	        data    : {'id':id},
	        success:function(data){

	        	$('#accountant').empty();  

   				$.each(data, function(key, value){
   			
      				$('#accountant').append('<option value=' + value.id + '>'+value.name+'</option>');
      				$('.chosen-select').trigger("chosen:updated");
   				});

	        }
	       
	    	});

	    	$.ajax({
	        type    : 'get',
	        url     : '/admin/management/task/'+ task_id +'/edit/findDocument/'+id,
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