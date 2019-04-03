@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('main-section')

    <div class="row">

    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-30">
                            Manage Sites
                        </h5>
                        @can('sites.create' , \Illuminate\Support\Facades\Auth::user())
                            <a href="{{route('business_sites.create')}}" class="btn btn-success"><span class="fa fa-plus"></span> Add Site
                            </a>
                        @endcan
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover table-bordered display mb-30" >
                                    <thead>
                                    <tr>
                                        <th rowspan="2">Site Name</th>
                                        <th colspan="5">Site Information</th>
                                        <th colspan="3">Owners Contact Information</th>
                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        <th>Owned By</th>
                                        <th>Business Type</th>
                                        <th>Franchise</th>
                                        <th>Province</th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Contact Email</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Site Name</th>
                                        <th>Owned By</th>
                                        <th>Business Type</th>
                                        <th>Franchise</th>
                                        <th>Province</th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Contact Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($sites as $site)
                                        <tr>
                                            <td><a href="{{route('visitations_list' , ['id' => $site->id])}}" class="text-primary">{{$site->site_name}}</a></td>
                                            <td><a href="{{route('business_group_dashboard' , ['id' => $site->business_group_id])}}" class="text-primary">{{$site->business_group_name}}</a></td>
                                            <td>{{$site->business_type}}</td>
                                            <td>{{$site->franchise_name}}</td>
                                            <td>{{$site->province}}</td>
                                            <td>
                                                @if($site->status == 1)
                                                    Inactive
                                                @else
                                                    Active
                                                @endif
                                            </td>
                                            <td>{{$site->owned_by}}</td>
                                            <td>{{$site->contact_number}}</td>
                                            <td>{{$site->owners_email}}</td>
                                            <td>
                                                @can('sites.update' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('business_sites.edit' , ['id' => $site->id])}}"  title="" data-original-title="Edit Site" data-toggle="tooltip"> <span class="fa fa-pencil"></span></a>
                                                @endcan
                                                {{--<a href="{{route('visitations_list' , ['id' => $site->id])}}" data-original-title="View Site" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a>--}}
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
    <!-- /Row -->
@endsection

@section('custom-scripts')
    <script src="{{asset('assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/dataTables-data.js')}}"></script>
@endsection