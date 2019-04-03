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
                            Add Business Retail Group
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('business_group.store')}}" method="post">
                                @csrf
                                @method('POST')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Business Retail Group Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('ceo_name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">CEO/Business Owners Name</label>
                                            <select name="ceo_name" id="ceo_name" class="form-control select2">
                                                @foreach($business_owners as $b)
                                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('ceo_name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('ceo_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{old('contact_number')}}">
                                            @if ($errors->has('contact_number'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email</label>
                                            <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{old('contact_email')}}">
                                            @if ($errors->has('status'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">
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
                                            <input type="text" class="form-control" name="city" id="city" value="{{old('name')}}">
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
                                            <select name="province" class="form-control" id="province">
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
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('business_type') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Business Type</label>
                                            <select name="business_type" id="business_type" class="form-control select2">
                                                    <option value="Individual">Individual</option>
                                                    <option value="Group">Group</option>
                                            </select>
                                            @if ($errors->has('business_type'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('business_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Business Retail Group</button>
                                            <a href="{{route('business_group.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        title: "Business Retail Group Name",
                        content: "Use the field to enter the name of the business retail group"
                    },
                    {
                        element: "#ceo_name",
                        title: "Ceo Name",
                        content: "Use the field to enter the name of the business retail group ceo"
                    },
                    {
                        element: "#contact_number",
                        title: "Contact Number",
                        content: "Use the field to enter contact number"
                    },

                    {
                        element: "#contact_email",
                        title: "Contact Email",
                        content: "Use the field to enter email address"
                    },
                    {
                        element: "#address",
                        title: "Address",
                        content: "Use the field to enter  address"
                    },
                    {
                        element: "#city",
                        title: "City",
                        content: "Use the field to enter city"
                    },
                    {
                        element: "#province",
                        title: "Province",
                        content: "Use the field to enter city"
                    },
                    {
                        element: "#create_button",
                        title: "Create Permission",
                        content: "Use the button to create a new business retail group"
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
@endsection