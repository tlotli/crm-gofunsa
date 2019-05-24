@extends('layouts.app')

@section('custom-styles')
    <!-- Bootstrap Datetimepicker CSS -->
    <link href="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css"/>

    <!-- select2 CSS -->
    <link href="{{asset('assets/vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- switchery CSS -->
    <link href="{{asset('assets/vendors/bower_components/switchery/dist/switchery.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- bootstrap-select CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- bootstrap-tagsinput CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css"/>

    <!-- bootstrap-touchspin CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- multi-select CSS -->
    <link href="{{asset('assets/vendors/bower_components/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Switches CSS -->
    <link href="{{asset('assets/vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('main-section')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-10">
                            Add Customer Contact
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('events.store')}}" method="post">
                                @csrf
                                @method('POST')
                                {{--<div class="row ">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">--}}
                                            {{--<label class="control-label mb-10 text-left">Event Name</label>--}}
                                            {{--<input type="text" class="form-control" name="title" id="title" value="{{old('title')}}">--}}
                                            {{--@if ($errors->has('title'))--}}
                                                {{--<span class="text-danger" >--}}
                                                    {{--<strong>{{ $errors->first('title') }}</strong>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Select Site </label>
                                            <select name="site_id" id="site_id" class="form-control select2">
                                                @foreach($sites as $s)
                                                    <option value="{{$s->id}}">{{$s->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Event Type </label>
                                            <select name="event_type" id="event_type" class="form-control">
                                                <option value="activation">Activation</option>
                                                <option value="bc_visit">Business Consultant Visit</option>
                                                <option value="call">Call</option>
                                                <option value="email">Email</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Start Date</label>
                                            <div class='input-group date datetimepicker1' >
                                                <input type='text' name="start_date"  class="form-control" />
                                                <span class="input-group-addon">
												    <span class="fa fa-calendar" id="start_date"></span>
												</span>
                                                @if ($errors->has('start_date'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('start_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">End Date</label>
                                            <div class='input-group date datetimepicker1' >
                                                <input type='text' name="end_date"  class="form-control" />
                                                <span class="input-group-addon">
												    <span class="fa fa-calendar" id="end_date"></span>
												</span>
                                                @if ($errors->has('end_date'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('end_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10">Assign Users</label>
                                            <select name="user_id[]" class="select2 select2-multiple" multiple="multiple" data-placeholder="Click to assign users to events">
                                                @foreach($users as $u)
                                                    <option value="{{$u->id}}">{{$u->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Notes</label>
                                            <textarea name="notes" id="notes" class="form-control" rows="10">{{old('notes')}}</textarea>
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
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create </button>
                                            <a href="{{route('events.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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

    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>
    <!-- Select2 JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>

    <!-- Multiselect JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>

    <!-- Bootstrap Touchspin JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>


    <!-- Bootstrap Switch JavaScript -->
    <script src="{{asset('assets/vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js')}}"></script>


    {{--<!-- Form Advance Init JavaScript -->--}}
    <script src="{{asset('assets/dist/js/form-advance-data.js')}}"></script>




    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#title",
                        title: "Title",
                        content: "Use the field to enter the name of the event "
                    },
                    {
                        element: "#start_date",
                        title: "Start Date",
                        content: "Click on the calendar icon to select the start date for the event"
                    },
                    {
                        element: "#end_date",
                        title: "End Date",
                        content: "Click on the calendar icon to select the end date for the event"
                    },
                    {
                        element: "#back",
                        title: "Back Button",
                        content: "Use the button to return to the previous page"
                    },
                ]});
            // Initialize the tour
            tour.init();
            // Start the tour
            tour.restart();
            storage:false;
        });
    </script>

    <script>
        $(function () {
            $('.datetimepicker1').datetimepicker({
                useCurrent: false,
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
            }).on('dp.show', function() {
                if($(this).data("DateTimePicker").date() === null)
                    $(this).data("DateTimePicker").date(moment());
            });
        });

    </script>



@endsection





