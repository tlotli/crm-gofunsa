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
                                        Manage Permissions <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                                    </h5>
                                    <a href="{{route('permissions.create')}}" id="create_button" class="btn btn-success"><span class="fa fa-plus"></span> Add Permission</a>
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
                                                    <th>Permission Name</th>
                                                    <th>Permission Type</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Permission Name</th>
                                                    <th>Permission Type</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($permission_types as $p)
                                                    <tr>
                                                        <td>{{$loop->index + 1}}</td>
                                                        <td id="permission_name">{{$p->permission_name}}</td>
                                                        <td id="permission_type_name">{{$p->permission_type_name}}</td>
                                                        <td>
                                                            <a href="{{route('permissions.edit' , ['id' => $p->permission_id])}}" id="edit" class="pr-10" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                                            <form id="delete-permission-{{$p->permission_id}}" method="post" action="{{route('permissions.destroy' , ['id' => $p->permission_id])}}" style="display: none">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                            </form>

                                                            <a href="" id="delete" class="text-inverse" title="Delete"
                                                               onclick="if(confirm('Are you sure you want to delete post ?')) {
                                                                       event.preventDefault(); document.getElementById('delete-permission-{{$p->permission_id}}').submit();
                                                               }
                                                               else
                                                                   {
                                                                       event.preventDefault();
                                                                   }"
                                                            ><i class="zmdi zmdi-delete"></i></a>
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
                        element: "#permission_name",
                        title: "Permission Name",
                        content: "Displays the name of the created permission"
                    },
                    {
                        element: "#permission_type_name",
                        title: "Permission Type Name",
                        content: "Displays the name of the created permission type"
                    },
                    {
                        element: "#edit",
                        title: "Edit Permission",
                        content: "Use the button to edit the permission"
                    },
                    {
                        element: "#delete",
                        title: "Delete Permission",
                        content: "Use the button to delete permission"
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