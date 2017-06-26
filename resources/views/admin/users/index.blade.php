@extends('layouts.admin')

@section('page_title')

Users

@endsection

@section('content')
	
	<div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Users
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href= "{{route('admin.users.create')}}" type="button" class="btn btn-primary waves-effect">+Add</a>
                                </div>
                            </div>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                @if($users)
									@foreach($users as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->role->name}}</td>
										<td>{{$user->is_active == 1 ? 'Active' : 'Not Active'}}</td>
										
                                        <td>
                                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteUsers"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>

                                    @endforeach
								@endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
                
            
            <!-- Add Users -->
            <div class="modal fade" id="addUsers" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add a User</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        
                                        <div class="body">
                                            <form id="wizard_with_validation" method="POST">
                                                <h3>Account Information</h3>
                                                <fieldset>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="username" required>
                                                            <label class="form-label">Username*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="password" class="form-control" name="password" id="password" required>
                                                            <label class="form-label">Password*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="password" class="form-control" name="confirm" required>
                                                            <label class="form-label">Confirm Password*</label>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <h3>Profile Information</h3>
                                                <fieldset>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" required>
                                                            <label class="form-label">First Name*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="surname" class="form-control" required>
                                                            <label class="form-label">Last Name*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="email" name="email" class="form-control" required>
                                                            <label class="form-label">Email*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                            <label class="form-label">Address*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="number" name="age" class="form-control" required>
                                                            <label class="form-label">Age*</label>
                                                        </div>
                                                        
                                                    </div>
                                                </fieldset>

                                                <h3>Terms & Conditions - Finish</h3>
                                                <fieldset>
                                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
           <!--End Add Users--> 
            
            
            <!-- Edit Users -->
            <div class="modal fade" id="editUsers" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit user information</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        
                                        <div class="body">
                                            <form id="wizard_with_validation_edit" method="POST">
                                                <h3>Account Information</h3>
                                                <fieldset>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" class="form-control" name="username" required>
                                                            <label class="form-label">Username*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="password" class="form-control" name="password" id="password" required>
                                                            <label class="form-label">Password*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="password" class="form-control" name="confirm" required>
                                                            <label class="form-label">Confirm Password*</label>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <h3>Profile Information</h3>
                                                <fieldset>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" required>
                                                            <label class="form-label">First Name*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="text" name="surname" class="form-control" required>
                                                            <label class="form-label">Last Name*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="email" name="email" class="form-control" required>
                                                            <label class="form-label">Email*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
                                                            <label class="form-label">Address*</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <div class="form-line">
                                                            <input type="number" name="age" class="form-control" required>
                                                            <label class="form-label">Age*</label>
                                                        </div>
                                                        
                                                    </div>
                                                </fieldset>

                                                <h3>Terms & Conditions - Finish</h3>
                                                <fieldset>
                                                    <input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
                                                    <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
           <!--End Edit Users--> 
            
            
            <!-- Delete Users -->
            <div class="modal fade" id="deleteUsers" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete a user</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">DELETE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete Users--> 

        </div>

	
@stop