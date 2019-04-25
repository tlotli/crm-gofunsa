@extends('layouts.app')

@section('custom-styles')
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
                                        <h1 class="text-center" style="color : #000; padding-top: 60px">{{$site->name}}</h1>
{{--                                        <p style="color: #000; padding-bottom: 30px" class="ml-30"><span class="fa fa-map"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->address .' , ' . $site->city . ' , ' . $site->province}}</small> </p>--}}
                                    {{--@endforeach--}}

                                </div>
                            </div>
                            <div class="profile-info text-center">
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Owned By</h5>
                                {{--@foreach($site as $s)--}}
                                    <h6 class="block capitalize-font pb-20">{{ $site->owner_name }}</h6>
                                {{--@endforeach--}}
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
                        {{--@foreach($site as $s)--}}
                            <form action="{{route('site_search' , ['id' => $site->id])}}" method="post">
                                {{--@endforeach--}}
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
                        <form action="{{route('site_search_by_quater' , ['id' => $site_id])}}" method="post">
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
                        {!! $stock_sold_to_date_chart->html() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        {!! $stock_sold_to_date_chart_month->html() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-scripts')
    <script src="{{asset('assets/dist/js/Chart.js')}}"></script>
    {{--{!! $soh_line_chart->script() !!}--}}
    {{--{!! $soh_line_chart_mtd->script() !!}--}}
    {!! $stock_sold_to_date_chart->script() !!}
    {!! $stock_sold_to_date_chart_month->script() !!}
@endsection



