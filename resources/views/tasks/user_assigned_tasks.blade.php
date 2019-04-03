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
                            My Tasks
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
                                        <th>Assigned To</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Province</th>
                                        <th>Assigned To</th>
                                        <th>Notes</th>
                                        <th>Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($sites as $s)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$s->site_name}}</td>
                                            <td>{{$s->province}}</td>
                                            <td>{{$s->assigned_to}}</td>
                                            <td>
                                                {{ str_limit($s->task_notes , 100) }}
                                            </td>
                                            @if($s->status == 0)
                                                <td ><a href="{{route('create_visitation', ['id' => $s->site_id] )}}" class="text-warning">Not Completed</a></td>
                                            @else
                                                <td class="text-success">Completed</td>
                                            @endif
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