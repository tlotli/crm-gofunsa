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
                            Edit Business Site
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('business_sites.update' , ['id' => $site->id])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Site Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$site->name}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('franchise_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Franchise</label>
                                            <select  name="franchise_id" id="franchise_id" class="form-control select2">
                                                @foreach($franchise as $f)
                                                    <option value="{{$f->id}}"
                                                            @if($site->franchise_id == $f->id)
                                                                 selected
                                                            @endif
                                                    >{{$f->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('franchise_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('franchise_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('business_group_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Owned By</label>
                                            <select  name="business_group_id" id="business_group_id" class="form-control select2">
                                                @foreach($business_groups as $bg)
                                                    <option value="{{$bg->id}}"
                                                            @if($bg->id == $site->business_group_id)
                                                                selected
                                                            @endif
                                                    >{{$bg->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('business_group_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('business_group_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Status</label>
                                            <select name="status" class="form-control"  id="">
                                                @if($site->status == 0)
                                                    <option value="0" selected>Active</option>
                                                    <option value="1">Inactive</option>
                                                @else
                                                    <option value="0">Active</option>
                                                    <option value="1" selected>Inactive</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('status'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Address</label>
                                            <input type="text" class="form-control" name="address" id="txtPlaces" value="{{$site->address}}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">City</label>
                                            <input type="text" class="form-control" name="city" id="contact_person" value="{{$site->city}}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Province</label>
                                            <select name="province" id="province" class="form-control select2">
                                                @foreach($province as $p)
                                                    <option value="{{$p->name}}"
                                                            @if($site->province == $p->name)
                                                                selected
                                                            @endif
                                                    >{{$p->name}}</option>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Update Site</button>
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