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
                            Visitations
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
                                        <th>Type Of Visitation</th>
                                        <th>Date Visitation</th>
                                        <th>Number Of Days Since Visit</th>
                                        <th>Notes</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Type Of Visitation</th>
                                        <th>Date Visitation</th>
                                        <th>Number Of Days Since Visit</th>
                                        <th>Notes</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($visitations as $v)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$v->site_name}}</td>
                                            <td>{{$v->type_of_visitation}}</td>
                                            <td>{{$v->date_visited}}</td>
                                            {{--@if()--}}
                                                <td>{{$v->days_last_visited}}</td>
                                            {{--@endif--}}
                                            <td>{{ str_limit($v->notes ,100)  }}</td>
                                            <td>
                                                <a href="{{route('visitations_list' , ['id' => $v->site_id])}}" data-original-title="View Visitations" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a>
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