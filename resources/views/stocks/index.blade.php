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
                                    {{--@foreach($site as $s)--}}
                                    <h1 class="text-center" style="color : #000; padding-top: 60px">{{$site->name}}</h1>
                                    {{--<p style="color: #000;" class="ml-30"><span class="fa fa-user"></span> <small style="font-size: 0.95rem ; color:#000">{{$site->retailer . ' - ' . $site->manager_1 . ' - ' . $site->manager_2}}</small> </p>--}}
                                    <p style="color: #000;" class="ml-30"><span class="fa fa-phone"></span> <small style="font-size: 0.95rem ; color:#000">{{$site->retailer_contact_no . ' - ' . $site->landline . ' - ' .$site-> 	cellphone }}</small> </p>
                                    <p style="color: #000" class="ml-30"><span class="fa fa-envelope"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->email_1 . ' - ' .$site->email_2  }}</small> </p>
                                    <p style="color: #000; padding-bottom: 30px" class="ml-30"><span class="fa fa-map"></span> <small  style=";font-size: 0.95rem ; color:#000">{{$site->address}}</small> </p>
                                    {{--@endforeach--}}

                                </div>
                            </div>
                            <div class="profile-info text-center">
                                <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-danger">Managed By</h5>
                                <h6 class="block capitalize-font pb-20">{{$site->manager_1 . ' - ' . $site->manager_2 }}</h6>
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

                                {{--@foreach($site as $s)--}}
                                    <li  role="presentation" ><a  href="{{route('visitations_list' , ['id' => $site->id])}}" aria-expanded="false">Visitations</a></li>
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    {{--<li  role="presentation"><a  href="{{route('site_contacts' , ['id' => $site->id])}}" aria-expanded="false">Contacts</a></li>--}}
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    <li  role="presentation" class="active"><a  id="profile_tab_8" href="{{route('soh_list' , ['id' => $site->id])}}" aria-expanded="false">Manage Stock On Hand</a></li>
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    <li role="presentation"  class=""><a id="profile_tab_9" href="{{route('capture_quantity_sold_list' , ['id' => $site->id])}}" aria-expanded="false">Manage Quantity Sold</a></li>
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    <li role="presentation"  ><a  id="profile_tab_10" href="{{route('uploads' , ['id' => $site->id])}}" aria-expanded="false">Documents</a></li>
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    <li role="presentation"  ><a  id="profile_tab_10" href="{{route('invoices.index' , ['id' => $site->id])}}" aria-expanded="false">Invoices</a></li>
                                {{--@endforeach--}}

                                {{--@foreach($site as $s)--}}
                                    <li role="presentation" class=""><a  id="profile_tab_10" role="tab" href="{{ route('site_report' , ['id' => $site->id]) }}" aria-expanded="false">Reports</a></li>
                                {{--@endforeach--}}
                            </ul>

                            <div class="tab-content" id="myTabContent_7">

                                <div id="profile_7" class="tab-pane fade active in" role="tabpanel">

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <div class="panel panel-default card-view panel-refresh">
                                                <div class="refresh-container">
                                                     <div class="la-anim-1"></div>
                                                </div>
                                            <div class="panel-heading">
                                                <div class="pull-left">
                                                </div>
                                                <div class="pull-left">

                                                    {{--@can('stock_sold.create' , \Illuminate\Support\Facades\Auth::user())--}}
                                                        {{--@foreach($site as $s)--}}
                                                            <a href="{{route('capture_soh' ,['id' => $site->id])}}" class="pull-right btn btn-success  mr-15"><span class="fa fa-plus"></span> Capture SOH</a>
                                                        {{--@endforeach--}}
                                                    {{--@endcan--}}

                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body row pa-0">
                                                    <div class="table-wrap">
                                                            <div class="table-responsive">
                                                            <div id="datable_1_wrapper" class="dataTables_wrapper no-footer"><table id="datable_1" class="table  display table-hover border-none dataTable no-footer" role="grid">
                                                                    <thead>
                                                                        <tr role="row">
                                                                        <th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending"  style="width: 95px;">#</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1"  style="width: 272px;"> Notes</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1"  style="width: 101px;">SOH</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1"  style="width: 92px;">Date Captured</th>
                                                                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1"  style="width: 126px;">Captured By </th>
                                                                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1"  style="width: 126px;">Action</th>
                                                                    </thead>
                                                                <tbody>
                                                                @foreach($soh as $s)
                                                                    <tr role="row" class="odd">
                                                                        <td class="sorting_1">{{$loop->index + 1}}</td>
                                                                        <td>{{$s->notes}}</td>
                                                                        <td>{{$s->soh}}</td>
                                                                        <td>
                                                                        {{$s->date_captured}}
                                                                        </td>
                                                                        <td>
                                                                        {{$s->captured_by}}
                                                                        </td>
                                                                        <td>
                                                                            {{--@foreach($site as $sites)--}}
                                                                             <a href="{{route('edit_soh' , ['id' => $s->id , 'site_id' => $site->id])}}"  title="" data-original-title="Edit Stock" data-toggle="tooltip"> <span class="fa fa-pencil"></span></a>
                                                                            {{--@endforeach--}}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
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



