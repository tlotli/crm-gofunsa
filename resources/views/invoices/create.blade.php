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
                                    {{--@foreach($site as $s)--}}
                                    <h1 class="text-center" style="color : #000; padding-top: 60px">{{$site->name}}</h1>
                                    <p style="color: #000;" class="ml-30"><span class="fa fa-user"></span> <small style="font-size: 0.95rem ; color:#000">{{$site->manager_name}}</small> </p>
                                    <p style="color: #000;" class="ml-30"><span class="fa fa-phone"></span> <small style="font-size: 0.95rem ; color:#000">{{$site->manager_cellphone }}</small> </p>
                                    <p style="color: #000" class="ml-30"><span class="fa fa-envelope"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->manager_email }}</small> </p>
                                    <p style="color: #000; padding-bottom: 30px" class="ml-30"><span class="fa fa-map"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->address .' , ' . $site->city . ' , ' . $site->province}}</small> </p>
                                    {{--@endforeach--}}

                                </div>
                            </div>
                            <div class="profile-info text-center">
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Owned By</h5>
                                <h6 class="block capitalize-font pb-20">{{$site->owner_name }}</h6>
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
                        <h6 class="panel-title txt-dark">Capture Invoice </h6>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            {{--@foreach($site as $s)--}}
                                <form action="{{route('invoice_store' , ['id' => $site->id])}}" method="post" enctype="multipart/form-data">
                                    {{--@endforeach--}}
                                    @csrf
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('who_invoiced') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Invoiced By</label>
                                                <input type="text" class="form-control" name="who_invoiced" value="{{old('who_invoiced')}}">
                                                @if ($errors->has('who_invoiced'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('who_invoiced') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('date_invoiced') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Invoice Date</label>
                                                <input id="date_invoiced" type="date" class="form-control" name="date_invoiced" value="{{old('date_invoiced')}}">
                                                @if ($errors->has('date_invoiced'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('date_invoiced') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Quantity</label>
                                                <input type="number" class="form-control" name="quantity" value="{{old('quantity')}}">
                                                @if ($errors->has('quantity'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('quantity') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">VAT</label>
                                                <input type="text" class="form-control" name="vat" value="{{old('vat')}}">
                                                @if ($errors->has('vat'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('vat') }}</strong>
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
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Invoice Status</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="0">Invoiced</option>
                                                    <option value="1">Not Invoiced</option>
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
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('invoice_attachment') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">Attach Invoice</label>
                                                <input type="file" name="invoice_attachment" class="">
                                                @if ($errors->has('invoice_attachment'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('invoice_attachment') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button id="create" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Invoice</button>
                                                {{--@foreach($site as $s)--}}
                                                    <a href="{{route('invoices.index' ,['id' => $site->id])}}" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
                                                {{--@endforeach--}}
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



