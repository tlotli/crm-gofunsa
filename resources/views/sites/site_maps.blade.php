@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>

    <style type="text/css">
        #mymap {
            border:1px solid red;
            width: auto;
            height: 500px;
        }
    </style>
@endsection

@section('main-section')

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Filter Sites By Franchise</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{route('site_franchise_filter')}}" method="post">
                            @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-sm-12 col-xs-12 form-group ">
                                        <label style="font-weight:bold;" for="franchise_id">Select Franchise:</label>
                                        <select name="franchise_id" id="franchise_id" class="form-control">
                                            @foreach($franchises as $f)
                                                <option value="{{$f->id}}">{{$f->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                        <button type="submit" style="padding:10px ; margin-top: 20px; font-weight: bold" class="btn btn-success">Filter <span class="fa fa-search"></span></button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>


        {{--<div class="col-sm-6">--}}
            {{--<div class="panel panel-default card-view">--}}
                {{--<div class="panel-heading">--}}
                    {{--<div class="pull-left">--}}
                        {{--<h6 class="panel-title txt-dark">Filter Sites By Site Owner</h6>--}}
                    {{--</div>--}}
                    {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="panel-wrapper collapse in">--}}
                    {{--<div class="panel-body">--}}
                        {{--<form action="{{route('site_owner_filter')}}" method="post">--}}
                            {{--@csrf--}}
                            {{--<div class="row justify-content-center">--}}
                                {{--<div class="col-md-8 col-sm-12 col-xs-12 form-group ">--}}
                                    {{--<label style="font-weight:bold;" for="franchise_id">Select Site Owner:</label>--}}
                                    {{--<select name="business_group_id" id="business_group_id" class="form-control">--}}
                                        {{--@foreach($owners as $o)--}}
                                            {{--<option value="{{$o->id}}">{{$o->name}}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}

                                {{--<div class="col-md-4 col-sm-12 col-xs-12 form-group">--}}
                                    {{--<button type="submit" style="padding:10px ; margin-top: 20px; font-weight: bold" class="btn btn-success">Filter <span class="fa fa-search"></span></button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        </div>




    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div id="weather_3" class="panel panel-default card-view pa-0 weather-success">
                                <div class="panel-wrapper collapse in">

                                    <div class="col-xs-12 pa-0">
                                        <div class="right-block-wrap pa-30">
                                            <div id="mymap">
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

        var locations = {!! json_encode($locations->toArray()) !!};


        var mymap = new GMaps({

            el: '#mymap',

            lat: -26.270760,

            lng: 28.112268,

            zoom:5

        });


        $.each( locations, function( index, value ){

            mymap.addMarker({

                lat: value.address_latitude,

                lng: value.address_longitude,

                title: value.name,

                click: function(e) {
                    alert('Site Name: ' + value.name);
                }

            });

        });
    </script>

@endsection




