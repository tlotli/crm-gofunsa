@extends('layouts.app')

@section('custom-styles')
@endsection

@section('main-section')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-10">
                            Edit Business Owner
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('business_owner.update' , ['id' => $business_owner->id ])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Business Owner Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$business_owner->name}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{$business_owner->contact_number}}">
                                            @if ($errors->has('contact_number'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{$business_owner->email}}">
                                            @if ($errors->has('email'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-pencil-square"></span> Edit Business Owner</button>
                                            <a href="{{route('business_owner.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
    <script>
        $("#demo").click(function(){
            var tour = new Tour({
                steps: [
                    {
                        element: "#name",
                        title: "Business Owner Name",
                        content: "Use the field to enter the name and surname of the business owner "
                    },
                    {
                        element: "#contact_number",
                        title: "Contact Number",
                        content: "Use the field to enter the name of the business owner contact number"
                    },
                    {
                        element: "#email",
                        title: "Email",
                        content: "Use the field to enter the name of the business email address"
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