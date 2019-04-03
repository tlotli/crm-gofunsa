@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
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

                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="tab-struct custom-tab-1 mt-40">
                            <ul role="tablist" class="nav nav-tabs" id="myTabs_7">

                                @foreach($site as $s)
                                    <li  role="presentation" ><a  href="{{route('visitations_list' , ['id' => $s->id])}}" aria-expanded="false">Visitations</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li  role="presentation"><a  href="{{route('site_contacts' , ['id' => $s->id])}}" aria-expanded="false">Contacts</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li  role="presentation" class=""><a  id="profile_tab_8" href="{{route('soh_list' , ['id' => $s->id])}}" aria-expanded="false">Manage Stock On Hand</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li role="presentation"  class=""><a id="profile_tab_9" href="{{route('capture_quantity_sold_list' , ['id' => $s->id])}}" aria-expanded="false">Manage Quantity Sold</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li role="presentation"  class="active"><a  id="profile_tab_10" href="{{route('uploads' , ['id' => $s->id])}}" aria-expanded="false">Documents</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li role="presentation"  ><a  id="profile_tab_10" href="{{route('invoices.index' , ['id' => $s->id])}}" aria-expanded="false">Invoices</a></li>
                                @endforeach

                                @foreach($site as $s)
                                    <li role="presentation" class=""><a  id="profile_tab_10" role="tab" href="{{ route('site_report' , ['id' => $s->id]) }}" aria-expanded="false">Reports</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content" id="myTabContent_7">

                                <div id="profile_7" class="tab-pane fade active in" role="tabpanel">


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="panel panel-default card-view">
                                                <div class="panel-heading">
                                                <div class="pull-left">
                                                <h6 class="panel-title txt-dark"></h6>
                                                </div>
                                                <div class="clearfix"></div>
                                                </div>
                                                <div class="panel-wrapper collapse in">
                                                <div class="panel-body">

                                                <div class="form-wrap">
                                                @foreach($site as $s)
                                                    <form action="{{route('upload_files' ,['id' => $s->id])}}" method="post" enctype="multipart/form-data">
                                                @endforeach
                                                @csrf
                                                <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group {{ $errors->has('documents') ? 'has-error' : '' }}">
                                                <label class="control-label mb-10 text-left">File upload</label>
                                                <input type="file" name="documents[]" id="" multiple>
                                                @if ($errors->has('documents'))
                                                    <span class="text-danger" >
                                                    <strong>{{ $errors->first('documents') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Upload Files</button>
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




                                    <div class="row">
                                    <div class="col-sm-12">
                                    <div class="panel panel-default card-view">
                                    <div class="panel-heading">
                                    <div class="clearfix"></div>
                                    </div>

                                    <div class="panel-body pa-0">
                                    <div class="">
                                    <div class="col-lg-12 col-md-12 pt-20">
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <div class="row">
                                    @foreach($documents as $d)
                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12  file-box">

                                        <div class="file">
                                        {{--<a href="{{Storage::url("documents/".$d->document_name)}}">--}}
                                        <a href="{{Storage::disk('local')->url("documents/".$d->document_name)}}">
                                        <div class="file-name">
                                        {{$d->document_name}}
                                        <br>
                                        <span>Upload Date: {{$d->created_at}}</span>
                                        <span>Uploaded By: {{$d->user_name}}</span>
                                        </div>
                                        </a>
                                        </div>
                                        </div>
                                    @endforeach

                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    </div>
                                    </div>
                                    </div>





                                </div>

                            </div>
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
    {{--<script src="{{asset('assets/dist/js/form-advance-data.js')}}"></script>--}}
    <script src="{{asset('assets/dist/js/Chart.js')}}"></script>

    <script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/dataTables-data.js')}}"></script>


    {{--<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>--}}
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




