@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        #map {
            border:1px solid red;
            width: auto;
            height: 500px;
        }
    </style>
@endsection

@section('main-section')
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div id="weather_3" class="panel panel-default card-view pa-0 weather-success">
                                <div class="panel-wrapper collapse in">

                                    <div class="panel-body  pa-0">
                                        <div class="profile-box">
                                            <div class="profile-cover-pic">

                                                <div class="">
                                                        <h1 class="text-center" style="color : #000; padding-top: 60px">Contact Type: {{ strtoupper($event->event_type) }}</h1>
                                                        <p style="color: #000;" class="ml-30"><span class="fa fa-clock-o"></span> <small style="font-size: 0.95rem ; color:#000">{{$event->start_date}}</small> </p>
                                                        <p style="color: #000;" class="ml-30"><span class="fa fa-clock-o"></span> <small style="font-size: 0.95rem ; color:#000">{{$event->end_date}}</small> </p>
                                                        <p style="color: #000" class="ml-30"><span class="fa fa-map-marker"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$event->address}}</small> </p>
                                                </div>

                                            </div>

                                            <div class="profile-info text-center">
                                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Assigned To</h5>
                                                    <span class="block capitalize-font pb-20">
                                                        @foreach($users as $u)
                                                            {{$u->name . ' ' }}
                                                        @endforeach
                                                    </span>
                                            </div>

                                            <div class="profile-info text-center">
                                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Notes</h5>
                                                <p class="block capitalize-font pb-20">{{$event->notes}}</p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-xs-12 pa-0">
                                        <div class="right-block-wrap pa-30">

                                            <div id="map">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom-scripts')
    <!-- Google Map JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBr-MAhWkR_g1QlngFU8x6rUerxUYc3wgI"></script>
    <script src="{{asset('js/gmaps.js')}}"></script>

    <script>

        var locations = {!! json_encode($event) !!};

    var map = new GMaps({
        el: '#map',
        lat: locations.address_latitude,
        lng: locations.address_longitude,
//        zoom:3
            });

        map.addMarker({
            lat: locations.address_latitude,
            lng: locations.address_longitude,
            title: locations.location,
        });

    </script>

@endsection




