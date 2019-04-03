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
                            Overdue Visitations Without Tasks
                        </h5>
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
                                        <th>Site Name</th>
                                        <th>Province</th>
                                        <th>Type Of Visitation</th>
                                        <th>Date Visitation</th>
                                        <th>Number Of Days Since Visit</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Province</th>
                                        <th>Type Of Visitation</th>
                                        <th>Date Visitation</th>
                                        <th>Number Of Days Since Visit</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($sites as $s)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$s->site_name}}</td>
                                            <td>{{$s->province}}</td>
                                            <td>{{$s->visitation_type}}</td>
                                            <td>{{$s->last_date_visited}}</td>
                                            <td>{{$s->number_of_days_since_visit}}</td>
                                            <td>
                                                <a href="{{route('visitations_list' , ['id' => $s->site_id])}}" data-original-title="View Visitations" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a>
                                                @can('tasks.assigned_tasks' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('create_visitations_without_tasks' , ['id' => $s->site_id ,
                                                                                                           'visitation_id' => $s->visitation_id
                                                    ])}}" data-original-title="Assign Task" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa  fa-plus-square"></span></a>
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
@endsection