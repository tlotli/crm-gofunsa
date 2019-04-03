@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('main-section')
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-30">
                            Manage Users <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>

                        @can('users.create' , \Illuminate\Support\Facades\Auth::user())
                            <a href="{{route('users.create')}}" id="add_user" class="btn btn-success"><span class="fa fa-plus"></span> Add User</a>
                        @endcan

                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th id="full_name">Full Name</th>
                                        <th id="role_assigned">Role Assigned</th>
                                        <th id="email">Email</th>
                                        <th id="status">Status</th>
                                        <th id="action">Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Role Assigned</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>
                                                {{$u->name}}
                                            </td>
                                            <td>{{$u->role_name}}</td>
                                            <td>{{$u->email}}</td>
                                            {{--<td>{{$u->created_by}}</td>--}}
                                            <td>
                                                @if($u->status == 0)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </td>
                                            <td>
                                                @can('users.update' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('users.edit' , ['id' => $u->id])}}" id="edit" class="pr-10" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                @endcan

                                                @can('users.reset_password' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('reset_password' , ['id' => $u->id])}}" id="password" class="pr-10" title="Reset Password"><i class="fa fa-key"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
@endsection

@section('custom-scripts')
    <script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/dataTables-data.js')}}"></script>

    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#add_user",
                        title: "Add User",
                        content: "Click on the button to add a new user"
                    },
                    {
                        element: "#full_name",
                        title: "Full name",
                        content: "Shows the full name of the user"
                    },
                    {
                        element: "#role_assigned",
                        title: "Role Assigned",
                        content: "Shows the name of the role that has been assigned to the user"
                    },
                    {
                        element: "#email",
                        title: "Email",
                        content: "Shows the email of the user"
                    },
                    {
                        element: "#status",
                        title: "Status",
                        content: "The current status of the user"
                    },
                    {
                        element: "#edit",
                        title: "Edit",
                        content: "Click on the link to update the profile of the user"
                    },
                    {
                        element: "#password",
                        title: "Password",
                        content: "Click on the link to update the users password"
                    }
                ]});
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.restart();
            storage:false;
        });
    </script>

@endsection