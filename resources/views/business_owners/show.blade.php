@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('main-section')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="panel panel-default card-view  pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body  pa-0">
                        <div class="profile-box">
                            <div class="profile-cover-pic">
                                <div class="">
                                    <h2 class="text-center" style="color : #000; padding-top: 60px">{{$business_owner->name}}</h2>
                                    <h6 class="text-center" style="color : #000">Business Owner</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">No Of Franchises By Province</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">line Chart</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $chart1->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Units Sold By Franchise (YTD)</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $chart2->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Units Sold By Franchise (MTD)</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $chart3->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Units Sold By Franchise (YTD)</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $chart4->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <!-- Select2 JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- Bootstrap Select JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <!-- Form Advance Init JavaScript -->
    {{--<script src="{{asset('assets/dist/js/form-advance-data.js')}}"></script>--}}
    <script src="{{asset('assets/dist/js/Chart.js')}}"></script>


    {{--<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>--}}
    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#name",
                        title: "Business Site Name",
                        content: "Use the field to enter the name of the business site "
                    },
                    {
                        element: "#business_group_id",
                        title: "Business Group",
                        content: "Use the field to select the group to which the site belongs to "
                    },
                    {
                        element: "#business_owner_id",
                        title: "Business Owner",
                        content: "Use the field to select the name of the business email owner"
                    },
                    {
                        element: "#province",
                        title: "Province",
                        content: "Use the the field to select the province for the site"
                    },
                    {
                        element: "#date_activated",
                        title: "Site Activation Date",
                        content: "Use the date picker to select the date that the site was activated "
                    },
                    {
                        element: "#contact_person",
                        title: "Contact Person",
                        content: "The contact person's name "
                    },
                    {
                        element: "#contact_number",
                        title: "Contact Person Number",
                        content: "The contact person telephone number "
                    },
                    {
                        element: "#contact_email",
                        title: "Contact Person Email",
                        content: "The contact person telephone email address "
                    },
                    {
                        element: "#create_button",
                        title: "Create",
                        content: "Click on the button to create a new site"
                    },


                ]});
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.restart();
            storage:false;
        });
    </script>

    {!! $chart->script() !!}
    {!! $chart1->script() !!}
    {!! $chart2->script() !!}
    {!! $chart3->script() !!}
    {!! $chart4->script() !!}
@endsection



