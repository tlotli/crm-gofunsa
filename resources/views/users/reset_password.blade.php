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
                            Change User Password <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">

                            <form action="{{route('change_password' , ['id' => $user->id])}}" method="post">
                                @csrf
                                {{--@method('PUT')--}}
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Password</label>
                                            <input id="password" type="password" class="form-control" name="password" value="{{old('password')}}">
                                            @if ($errors->has('password'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Confirm Password</label>
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create" class="btn btn-success mt-10"><span class=" fa fa-pencil-square"></span> Edit Password</button>
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
                        content: "Use the field to enter the name of the user(This field will be required to login)"
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
                        content: "Click on the button to update user password"
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