@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
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
                                    {{--@foreach($site as $s)--}}
                                    <h1 class="text-center" style="color : #000; padding-top: 60px">{{$site->owned_by . ' - ' . $site->business_type}}</h1>
                                    {{--@endforeach--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Filter Report By Date</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{route('business_group_dashboard_search' , ['id' => $business_group_id])}}" method="post">
                            @csrf
                            <div class="form-wrap">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                                        <label style="font-weight:bold;" for="start_date">From:</label>
                                        <input type="date" name="from"  class="form-control">
                                        @if ($errors->has('from'))
                                            <span class="text-danger" >
                                                    <strong>{{ $errors->first('from') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                                        <label style="font-weight:bold;" for="start_date">To:</label>
                                        <input type="date" name="to"  class="form-control">
                                        @if ($errors->has('to'))
                                            <span class="text-danger" >
                                                    <strong>{{ $errors->first('to') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                        <button type="submit" style="padding:10px ; margin-top: 20px; font-weight: bold" class="btn btn-success">Filter <span class="fa fa-search"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Filter Report By Quater</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{route('filter_business_groups_report_by_quater' , ['id' => $business_group_id] )}}" method="post">
                            @csrf
                            <div class="form-wrap">
                                <div class="row justify-content-center">
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group {{ $errors->has('from') ? 'has-error' : '' }}">
                                        <label style="font-weight:bold;" for="start_date">Year:</label>
                                        <input type="number" min="1900" max="2099" name="from" step="1" value="{{\Carbon\Carbon::now()->year}}" class="form-control" />
                                        @if ($errors->has('from'))
                                            <span class="text-danger" >
                                                    <strong>{{ $errors->first('from') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                                        <label style="font-weight:bold;" for="start_date">Quater:</label>
                                        <input type="number" min="1" max="4" name="to" step="1" value="1" class="form-control" />
                                        @if ($errors->has('to'))
                                            <span class="text-danger" >
                                                    <strong>{{ $errors->first('to') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                                        <button type="submit" style="padding:10px ; margin-top: 20px; font-weight: bold" class="btn btn-success">Filter <span class="fa fa-search"></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $sales_by_franchise_bar_chart->html() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $sales_average_by_franchise_bar_chart->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $sales_by_sites_bar_chart->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $sales_by_sites_average_bar_chart->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-30">
                            Site Report Detail
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
                                        <th>Franchise Name</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Site Name</th>
                                        <th>Franchise Name</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($detail_reports as $d)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$d->site_name}}</td>
                                            <td>{{$d->franchise_name}}</td>
                                            <td>{{$d->province}}</td>
                                            <td><a href="{{route('site_report' , ['id' => $d->site_id])}}" data-original-title="View Site" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a></td>
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

@endsection


@section('custom-scripts')
    <script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/dataTables-data.js')}}"></script>
    <script src="{{asset('assets/dist/js/Chart.js')}}"></script>
    {!! $sites_owned_by_group_by_franchise_bar_chart->script() !!}
    {!! $sites_owned_by_group_by_region_franchise_bar_chart->script() !!}
    {!! $sales_by_franchise_bar_chart->script() !!}
    {!! $sales_average_by_franchise_bar_chart->script() !!}
    {!! $sales_by_sites_bar_chart->script() !!}
    {!! $sales_by_sites_average_bar_chart->script() !!}
@endsection



