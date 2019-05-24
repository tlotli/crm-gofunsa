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
                                        <th colspan="8">Site Information</th>
                                        <th colspan="3">Contact Persons</th>
                                        <th rowspan="2">Action</th>
                                    </tr>
                                    <tr>
                                        <th>Physical Address</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Franchise</th>
                                        <th>Landline</th>
                                        <th>Cell No</th>
                                        <th>Alternative</th>
                                        <th>Emails</th>


                                        <th>Retailer</th>
                                        <th>First Manager</th>
                                        <th>Second Manger</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Site Name</th>
                                        <th>Physical Address</th>
                                        <th>City</th>
                                        <th>Province</th>
                                        <th>Franchise</th>
                                        <th>Landline</th>
                                        <th>Cell No</th>
                                        <th>Alternative</th>
                                        <th>Emails</th>


                                        <th>Retailer</th>
                                        <th>First Manager</th>
                                        <th>Second Manger</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($sites as $site)
                                        <tr>
                                            <td><a href="{{route('visitations_list' , ['id' => $site->id])}}" class="text-primary">{{$site->name}}</a></td>
                                            <td>{{$site->address}}</td>
                                            <td>{{$site->city}}</td>
                                            <td>{{$site->province}}</td>
                                            <td>{{$site->franchise->name}}</td>
                                            <td>
                                                {{$site->landline}}
                                            </td>
                                            <td>{{$site->cellphone}}</td>
                                            <td>{{$site->alternative}}</td>
                                            <td>{{$site->email_1 . ' - ' . $site->email_2}}</td>
                                            <td>{{$site->retailer}}</td>
                                            <td>{{$site->manager_1}}</td>
                                            <td>{{$site->manager_2}}</td>
                                            <td>
                                                @can('sites.update' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href="{{route('business_sites.edit' , ['id' => $site->id])}}"  title="" data-original-title="Edit Site" data-toggle="tooltip"> <span class="fa fa-pencil-square-o"></span></a>
                                                @endcan


                                                    <form id="delete-site-{{$site->id}}" method="post" action="{{route('business_sites.destroy' , ['id' => $site->id])}}" style="display: none">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                    </form>


                                                    @can('sites.delete' , \Illuminate\Support\Facades\Auth::user())
                                                        <a href=""  title="" data-original-title="Delete Site" data-toggle="tooltip"

                                                           onclick="if(confirm('Are you sure you want to delete site ?')) {
                                                                   event.preventDefault(); document.getElementById('delete-site-{{$site->id}}').submit();
                                                                   }
                                                                   else
                                                                   {
                                                                   event.preventDefault();
                                                                   }"
                                                        > <span class="zmdi zmdi-delete"></span></a>
                                                    @endcan

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