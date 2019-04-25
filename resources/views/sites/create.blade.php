@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('main-section')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-10">
                            Create Business Site
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('business_sites.store')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Site Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('franchise_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Franchise</label>
                                            <select name="franchise_id" id="franchise_id" class="form-control">
                                                @foreach($franchises as $f)
                                                    <option value="{{$f->id}}">{{$f->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('franchise_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('franchise_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Address</label>
                                            <input type="text" class="form-control" name="address" id="txtPlaces" value="{{old('address')}}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">City</label>
                                            <input type="text" class="form-control" name="city" id="city" value="{{old('city')}}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('surburb') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Surburb</label>
                                            <input type="text" class="form-control" name="surburb" id="surburb" value="{{old('surburb')}}">
                                            @if ($errors->has('surburb'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('surburb') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Province</label>
                                            <select name="province" id="province" class="form-control select2">
                                                @foreach($province as $p)
                                                    <option value="{{$p->name}}">{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('province'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('landline') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Landline</label>
                                            <input type="text" class="form-control" name="landline" id="landline" value="{{old('landline')}}">
                                            @if ($errors->has('landline'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('landline') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('cellphone') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Cellphone</label>
                                            <input type="text" class="form-control" name="cellphone" id="cellphone" value="{{old('cellphone')}}">
                                            @if ($errors->has('cellphone'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('cellphone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('email_1') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email 1</label>
                                            <input type="text" class="form-control" name="email_1" id="email_1" value="{{old('email_1')}}">
                                            @if ($errors->has('email_1'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('email_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('email_2') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email 2</label>
                                            <input type="text" class="form-control" name="email_2" id="email_2" value="{{old('email_2')}}">
                                            @if ($errors->has('email_2'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('email_2') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('alternative') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Alternative No</label>
                                            <input type="text" class="form-control" name="alternative" id="alternative" value="{{old('alternative')}}">
                                            @if ($errors->has('alternative'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('alternative') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('gofun_bc') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Go&Fun Bc</label>
                                            <input type="text" class="form-control" name="gofun_bc" id="gofun_bc" value="{{old('gofun_bc')}}">
                                            @if ($errors->has('gofun_bc'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('gofun_bc') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('retail_group_bc') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Retail Group Bc</label>
                                            <input type="text" class="form-control" name="retail_group_bc" id="retail_group_bc" value="{{old('retail_group_bc')}}">
                                            @if ($errors->has('retail_group_bc'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('retail_group_bc') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('retailer') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Retailer</label>
                                            <input type="text" class="form-control" name="retailer" id="retailer" value="{{old('retailer')}}">
                                            @if ($errors->has('retailer'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('retailer') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('retailer_contact_no') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Retailer Contact No</label>
                                            <input type="text" class="form-control" name="retailer_contact_no" id="retailer_contact_no" value="{{old('retailer_contact_no')}}">
                                            @if ($errors->has('retailer_contact_no'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('retailer_contact_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('manager_1') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Manager Name</label>
                                            <input type="text" class="form-control" name="manager_1" id="manager_1" value="{{old('manager_1')}}">
                                            @if ($errors->has('manager_1'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('manager_1') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('manager_2') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Manager Name (Alternative)</label>
                                            <input type="text" class="form-control" name="manager_2" id="manager_2" value="{{old('manager_2')}}">
                                            @if ($errors->has('manager_2'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('manager_2') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('on_board') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">On Board Status</label>
                                            <select name="on_board" id="on_board" class="form-control">
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                            @if ($errors->has('on_board'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('on_board') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                            <label class="control-label mb-10 text-left">Notes</label>
                                            <textarea name="notes" id="notes" class="form-control">{{old('notes')}}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Site</button>
                                            <a href="{{route('business_sites.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        element: "#address",
                        title: "Address",
                        content: "Use the field to capture the business address"
                    },
                    {
                        element: "#city",
                        title: "City",
                        content: "Use the field to add the city to which the city belongs to"
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


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBr-MAhWkR_g1QlngFU8x6rUerxUYc3wgI&libraries=places"></script>

    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
            google.maps.event.addListener(places, 'place_changed', function () {

            });
        });
    </script>
@endsection