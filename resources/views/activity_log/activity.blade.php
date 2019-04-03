@extends('layouts.app')

@section('custom-styles')
    {{--<link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">--}}
@endsection

@section('main-section')
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">

                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">


                        <div class="panel panel-default border-panel card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">recent activity</h6>
                                </div>
                                {{--<a class="txt-danger pull-right right-float-sub-text inline-block" href=""> clear all </a>--}}
                                <div class="clearfix"></div>
                            </div>

                            <div class="panel-wrapper task-panel collapse in">
                                    <div class="panel-body row pa-0">
                                        <div class="list-group mb-0">
                                            @foreach($logs as $l)
                                                <a href="#" class="list-group-item">
                                                    <span class="badge transparent-badge badge-info capitalize-font">{{$l->created_at->diffForHumans()}}</span>
                                                    @if($l->log_type = 'Users')
                                                            <i class="fa fa-user pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Roles')
                                                            <i class="fa fa-users pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Retail Groups')
                                                            <i class="fa fa-briefcase pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Business Owners')
                                                            <i class="fa fa-users pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Store Management')
                                                            <i class="fa fa-building-o pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Store Management')
                                                            <i class="fa fa-building-o pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Visitation')
                                                            <i class="fa fa-taxi pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'SOH')
                                                            <i class="fa fa-cubes pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Quantity Sold')
                                                            <i class="fa fa-money pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                        @elseif($l->log_type = 'Price')
                                                            <i class="fa fa-usd pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                    @else
                                                        <i class="fa fa-calendar pull-left"></i><p class="pull-left">{{$l->description}}</p>
                                                    @endif

                                                    <div class="clearfix"></div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                            </div>

                            <div class="text-center">
                                {{ $logs->links() }}
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
    {{--<script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>--}}
    {{--<script src="{{asset('assets/dist/js/dataTables-data.js')}}"></script>--}}
@endsection