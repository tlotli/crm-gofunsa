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
                                Manage Roles <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                        @can('roles.create' , \Illuminate\Support\Facades\Auth::user())
                            <a href="{{route('roles.create')}}" id="create_button" class="btn btn-success"><span class="fa fa-plus"></span> Add Roles</a>
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
                                        <th>Role Name</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($roles as $r)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td >{{$r->role_name}}</td>
                                            <td >{{$r->created_by}}</td>
                                            <td >{{$r->created_at}}</td>
                                            <td>
                                                @can('roles.update' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('roles.edit' , ['id' => $r->id])}}" id="edit" class="pr-10" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
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
                        element: "#create_button",
                        title: "Create Button",
                        content: "Click on the button to create a new permission"
                    },
                    {
                        element: "#role_name",
                        title: "Role Name",
                        content: "Displays the name of the created role"
                    },
                    {
                        element: "#role_created_by",
                        title: "Role Created By",
                        content: "The user that created the role"
                    },
                    {
                        element: "#edit",
                        title: "Edit Role",
                        content: "Use the button to edit the role"
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


