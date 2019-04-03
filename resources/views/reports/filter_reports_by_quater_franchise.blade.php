@extends('layouts.app')

@section('custom-styles')
@endsection

@section('main-section')


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
                        <form action="{{route('filter_franchise_reports')}}" method="post">
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
                        <h6 class="panel-title txt-dark">Filter reports by quater</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <form action="{{route('filter_franchise_reports_by_quater')}}" method="post">
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
        <div class="col-lg-12 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $number_of_franchises_pie->html() !!}
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
                        {!! $number_of_franchises_region_bar->html() !!}
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
                        {!! $sales_by_franchise_donut->html() !!}
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
                        {!! $data_sales_by_franchise_trend_bar->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('custom-scripts')
    <script src="{{asset('assets/dist/js/Chart.js')}}"></script>
    {!! $number_of_franchises_region_bar->script() !!}
    {!! $number_of_franchises_pie->script() !!}
    {!! $sales_by_franchise_donut->script() !!}
    {!! $data_sales_by_franchise_trend_bar->script() !!}
    {{--{!! $soh_line_chart_value->script() !!}--}}
@endsection



