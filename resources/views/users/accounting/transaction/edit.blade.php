@extends('layouts.admin')

@section('page_title')

Transaction

@endsection

@section('content')

<h1>Edit Transaction</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store']) !!}

    <div class = "form-group">
        {!! Form:: label('name', 'Name:') !!}
        {!! Form:: select('name', [''=>'Select Vendor/Customer'] ,null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: label('trans_date', 'Date:') !!}
        {!! Form:: date('trans_date',null, ['class'=>'form-control datepicker']) !!}
    </div>

    <div class = "form-group">
        {!! Form:: label('category', 'Category:') !!}
        {!! Form:: select('category', [''=>'Select Category'] ,null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: label('account', 'Account:') !!}
        {!! Form:: select('account', [''=>'Select Account'] ,null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: label('amount', 'Amount:') !!}
        {!! Form:: text('number',null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: label('tax', 'Tax:') !!}
        {!! Form:: select('tax', [''=>'VAT'] ,null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: label('amount', 'Total:') !!}
        {!! Form:: text('number',null, ['class'=>'form-control']) !!}

    </div>

    <div class = "form-group">
        {!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>
    
    {!! Form::close() !!}

    @include('includes.form_error')

@stop