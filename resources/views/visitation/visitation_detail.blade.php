@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('main-section')
    <!-- Row -->
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div id="weather_3" class="panel panel-default card-view pa-0 weather-info">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="row ma-0">
                            <div class="col-xs-6 pa-0">
                                <div class="left-block-wrap pa-30">
                                    <p class="block nowday " style="font-weight: bold">Site Name</p>
                                    <span class="block nowdate">{{$visitation->site_name}}</span>
                                    <div class="left-block  mt-15"></div>


                                    <p class="block nowday" style="font-weight: bold">Follow Up By</p>
                                    <span class="block nowdate">{{$visitation->user_name}}</span>
                                    <div class="left-block  mt-15"></div>


                                    <p class="block nowday" style="font-weight: bold">Follow Up Date</p>
                                    <span class="block nowdate">{{$visitation->date_visited}}</span>
                                    <div class="left-block  mt-15"></div>


                                    <p class="block nowday" style="font-weight: bold">Visitation Type</p>
                                    <span class="block nowdate">{{$visitation->visitation_type}}</span>
                                    <div class="left-block  mt-15"></div>


                                    <p class="block nowday" style="font-weight: bold">Notes</p>
                                    <span class="block nowdate">{{$visitation->notes}}</span>
                                    <div class="left-block  mt-15"></div>

                                </div>
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
