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
                            Deleted Sites
                        </h5>

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
                                                    <form id="restore-site-{{$site->id}}" method="post" action="{{route('restore_sites' , ['id' => $site->id])}}" style="display: none">
                                                        {{csrf_field()}}
                                                    </form>

                                                @can('sites.restore_sites' , \Illuminate\Support\Facades\Auth::user())
                                                    <a href=""  title="" data-original-title="Restore Site" data-toggle="tooltip"
                                                       onclick="if(confirm('Are you sure you want to restore site ?')) {
                                                               event.preventDefault(); document.getElementById('restore-site-{{$site->id}}').submit();
                                                               }
                                                               else
                                                               {
                                                               event.preventDefault();
                                                               }"
                                                    > <span class="icon-reload"></span></a>
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