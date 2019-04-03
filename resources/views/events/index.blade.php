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
                            Manage Events
                        </h5>
                        <a href="{{route('events.create')}}" id="create_button" class="btn btn-success"><span class="fa fa-plus"></span> Add Event</a>
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
                                        <th>Event Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Added By</th>
                                        <th>Date Created</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Event Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Added By</th>
                                        <th>Date Created</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($events as $e)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td id="event_name">{{$e->title}}</td>
                                            <td id="start_date">{{$e->start_date}}</td>
                                            <td id="end_date">{{$e->end_date}}</td>
                                            <td id="created_by">{{$e->name}}</td>
                                            <td id="date_created">{{$e->created_at}}</td>
                                            <td>
                                                <a href="{{route('events.edit' , ['id' => $e->id])}}" id="edit" class="pr-10" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                                <form id="delete-event-{{$e->id}}" method="post" action="{{route('events.destroy' , ['id' => $e->id])}}" style="display: none">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                </form>

                                                <a href="" id="delete" class="text-inverse" title="Delete"
                                                   onclick="if(confirm('Are you sure you want to delete event ?')) {
                                                           event.preventDefault(); document.getElementById('delete-event-{{$e->id}}').submit();
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



    <script>
        $(document).on('click', '.button', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                    title: "Are you sure!",
                    type: "error",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                },
                function() {
                    $.ajax({
                        type: "GET",
                        url: "{{url('events/')}}+id", // since your route has /{id}
                        data: {id:id},
                        success: function (data) {

                        }
                    });
                });
        });

    </script>
@endsection