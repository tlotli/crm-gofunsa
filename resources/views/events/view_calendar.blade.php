@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/fullcalendar/dist/fullcalendar.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('main-section')
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="calendar-wrap mt-40">
                            {!! $calendar->calendar()  !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
@endsection

@section('custom-scripts')
    <script src="{{asset('assets/vendors/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>

    {!! $calendar->script() !!}

@endsection