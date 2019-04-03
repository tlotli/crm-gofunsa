@extends('layouts.app')

@section('custom-styles')
@endsection

@section('main-section')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-10">
                            Edit User Profile <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('users.update' , ['id' => $user->id])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Full name</label>
                                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email</label>
                                            <input id="email" type="text" class="form-control" name="email" value="{{$user->email}}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Telephone</label>
                                            <input id="telephone" type="text" class="form-control" name="telephone" value="{{$user->telephone}}">
                                            @if ($errors->has('telephone'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('telephone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Job title</label>
                                            <input id="position" type="text" class="form-control" name="position" value="{{$user->position}}">
                                            @if ($errors->has('position'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('position') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('role_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Role</label>
                                            <select id="role_id" name="role_id" value="{{old('role_id')}}" id="" class="form-control">
                                                @foreach($roles as $r)
                                                    <option value="{{$r->id}}"
                                                            @foreach($user->roles as $ur)
                                                                @if($ur->pivot->role_id == $r->id)
                                                                    selected
                                                                @endif
                                                            @endforeach
                                                    >{{$r->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('role_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('role_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">User Status</label>
                                            <select id="user_status" name="status" id="" class="form-control">
                                                @if($user->status == 0)
                                                    <option value="0" selected>Active</option>
                                                    <option value="1">Inactive</option>
                                                    @else
                                                    <option value="0">Active</option>
                                                    <option value="1" selected>Inactive</option>
                                                @endif

                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create" class="btn btn-success mt-10"><span class=" fa fa-pencil-square"></span> Edit User</button>
                                            <a href="{{route('users.index')}}" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#name",
                        title: "User Name",
                        content: "Use the field to enter the name of the user (first name and last name)"
                    },
                    {
                        element: "#email",
                        title: "Email",
                        content: "Use the field to enter the email of the user(This field will be required to login)"
                    },
                    {
                        element: "#telephone",
                        title: "Telephone",
                        content: "Use the field to enter the cellphone number of the user"
                    },
                    {
                        element: "#position",
                        title: "Position",
                        content: "Use the field to enter the job title of the user"
                    },
                    {
                        element: "#role_id",
                        title: "Role Type",
                        content: "Use the select box to select the role for the user"
                    },
                    {
                        element: "#user_status",
                        title: "User Status",
                        content: "Use the select box to change the status of the user"
                    },
                    {
                        element: "#password",
                        title: "Password",
                        content: "Use the field to create a password for the user"
                    },
                    {
                        element: "#password_confirmation",
                        title: "Confirm Password",
                        content: "Use the field to create a password for the user"
                    },
                    {
                        element: "#create",
                        title: "Update User",
                        content: "Click on the button to update user details"
                    },
                ]});
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.restart();
            storage:false;
        });
    </script>
@endsection