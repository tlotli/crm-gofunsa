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
                            Manage Business Retail Group
                        </h5>

                        @can('business_groups.create' , \Illuminate\Support\Facades\Auth::user())
                            <a href="{{route('business_group.create')}}" id="create_button" class="btn btn-success"><span class="fa fa-plus"></span> Create Business Group</a>
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
                                        <th id="role_name">Business Retail Group Name</th>
                                        <th id="ceo">Ceo</th>
                                        <th id="business_type">Business Type</th>
                                        <th id="role_created_by">Contact Number</th>
                                        <th id="role_created_by">Contact Email</th>
                                        <th id="role_created_by">Address</th>
                                        <th id="status">Status</th>
                                        <th id="created_at">Created At</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Business Retail Group Name</th>
                                        <th>Ceo</th>
                                        <th>Business Type</th>
                                        <th>Contact Number</th>
                                        <th>Contact Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($business_groups as $b)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td >{{$b->business_name}}</td>
                                            <td >{{$b->ceo}}</td>
                                            <td >{{$b->business_type}}</td>
                                            <td >{{$b->contact_number}}</td>
                                            <td >{{$b->contact_email}}</td>
                                            <td >{{$b->address}}</td>
                                            <td >
                                                @if($b->status == 0)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif</td>
                                            <td >
                                                {{$b->created_at}}
                                            </td>

                                            <td>
                                                @can('business_groups.update' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('business_group.edit' , ['id' => $b->id])}}" id="edit" class="pr-10" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
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
                        content: "Click on the button to create a new business group"
                    },
                    {
                        element: "#role_name",
                        title: "Business Retail Group Name",
                        content: "Displays the name of the retail group"
                    },
                    {
                        element: "#role_created_by",
                        title: "Business Group Created By",
                        content: "The user that created the business retail group"
                    },
                    {
                        element: "#created_at",
                        title: "Business Group Created At",
                        content: "The datetime that the business group was created"
                    },
                    {
                        element: "#edit",
                        title: "Edit Business Group Details",
                        content: "Use the button to edit the business group detail"
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