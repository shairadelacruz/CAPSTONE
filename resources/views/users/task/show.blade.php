@extends('layouts.admin')

@section('page_title')

Documents

@endsection

@section('content')

<h1>{{$task->name}}</h1>

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

@stop