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
                            Create Franchise
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('franchise.store')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Franchise Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Franchise</button>
                                            <a href="{{route('franchise.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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