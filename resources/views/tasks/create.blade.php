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
                            Assign Task
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('store_visitations_without_tasks' , ['id' => $site->id , 'visitation_id' => $visitation->id])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('assigned_to') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Assign Task To</label>
                                            <select name="assigned_to" id="assigned_to" class="form-control">
                                                @foreach($users as $u)
                                                <option value="{{$u->id}}">{{$u->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('assigned_to'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('assigned_to') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Notes</label>
                                            <textarea name="notes" id="notes"  rows="10" class="form-control">{{old('notes')}}</textarea>
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
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Assign Task</button>
                                            <a href="{{route('overdue_visitations_without_tasks')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
@endsection


