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
                                    @foreach($site as $s)
                                        <h1 class="text-center" style="color : #000; padding-top: 60px">{{$s->site_name}}</h1>
                                        {{--<p style="color: #000;" class="ml-30"><span class="fa fa-user"></span> <small style="font-size: 0.95rem ; color:#000">{{$s->contact_person}}</small> </p>--}}
                                        {{--<p style="color: #000;" class="ml-30"><span class="fa fa-phone"></span> <small style="font-size: 0.95rem ; color:#000">{{$site->contact_number }}</small> </p>--}}
                                        {{--<p style="color: #000" class="ml-30"><span class="fa fa-envelope"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->contact_email }}</small> </p>--}}
                                        <p style="color: #000; padding-bottom: 30px" class="ml-30"><span class="fa fa-map"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$s->address .' , ' . $s->city . ' , ' . $s->province}}</small> </p>
                                    @endforeach

                                </div>
                            </div>
                            <div class="profile-info text-center">
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Owned By</h5>
                                @foreach($site as $s)
                                    <h6 class="block capitalize-font pb-20">{{$s->owned_by . ' - ' . $s->business_type}}</h6>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="panel panel-default card-view">

                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Capture Visitation </h6>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            @foreach($site as $s)
                            <form action="{{route('store_visitation' , ['id' => $s->id])}}" method="post">
                            @endforeach
                                @csrf
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('visitation_type_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Visitation Type</label>
                                            <select name="visitation_type_id" class="form-control" id="visitation_type_id">
                                                @foreach($visitation_types as $v)
                                                    <option value="{{$v->id}}">{{$v->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('visitation_type_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('visitation_type_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('date_visited') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Date </label>
                                            <input id="date_visited" type="date" class="form-control" name="date_visited" value="{{old('date_visited')}}">
                                            @if ($errors->has('date_visited'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('date_visited') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Notes</label>
                                            <textarea name="notes" id="notes" value="{{old('notes')}}" cols="30" rows="10" class="form-control"></textarea>
                                            @if ($errors->has('notes'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('notes') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Visitation</button>
                                            @foreach($site as $s)
                                                <a href="{{route('visitations_list' ,['id' => $s->id])}}" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

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
    <script src="{{asset('assets/dist/js/form-advance-data.js')}}"></script>

    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#reason_for_visit",
                        title: "Reason For Visit",
                        content: "Use the field to capture the reason for visiting the site"
                    },
                    {
                        element: "#date_visited",
                        title: "Date Visited",
                        content: "Use the field to capture the date you visited the site"
                    },
                    {
                        element: "#visitation_type_id",
                        title: "visit Type",
                        content: "Select the visitation type"
                    },
                    {
                        element: "#notes",
                        title: "Notes",
                        content: "Use the field to capture important information about the site visit"
                    },
                    {
                        element: "#create",
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
@endsection



