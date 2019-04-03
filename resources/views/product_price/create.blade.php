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
                            Set Product Price <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('set_price.store')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('price ') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Price</label>
                                            <input type="number" step=".01" class="form-control" name="price" id="price" value="{{old('price')}}">
                                            @if ($errors->has('price'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Set Price</button>
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
                        element: "#price",
                        title: "Price",
                        content: "use the field to set the selling price for the product"
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
                        content: "Use the button to set the price"
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