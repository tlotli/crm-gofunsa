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
                        <h6 class="panel-title txt-dark">Edit Site Contact </h6>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            @foreach($site as $s)
                                <form action="{{route('update_site_contact' , ['id' => $site_contact->id , 'site_id' => $s->id])}}" method="post">
                                    @endforeach
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Contact Name</label>
                                                <input id="contact_name" type="text" class="form-control" name="contact_name" value="{{$site_contact->contact_name}}">
                                                @if ($errors->has('contact_name'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('contact_phone') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Contact Phone</label>
                                                <input id="contact_phone" type="text" class="form-control" name="contact_phone" value="{{$site_contact->contact_phone}}">
                                                @if ($errors->has('contact_phone'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_phone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Contact Email</label>
                                                <input type="text" class="form-control" value="{{$site_contact->contact_email}}" name="contact_email">
                                                @if ($errors->has('contact_email'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Position</label>
                                                <input type="text" class="form-control" value="{{$site_contact->position}}" name="position">
                                                @if ($errors->has('position'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('position') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button id="create" type="submit" class="btn btn-success mt-10"><span class="fa fa-pencil"></span> Edit Contact</button>
                                                @foreach($site as $s)
                                                    <a href="{{route('site_contacts' ,['id' => $s->id])}}" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        element: "#soh",
                        title: "Stock On Hand",
                        content: "Use the filed to enter the number of units that are in stock"
                    },
                    {
                        element: "#date_captured",
                        title: "Date Captured",
                        content: "Use the field to capture the date you counted the stock"
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








