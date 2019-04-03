@extends('layouts.app')

@section('custom-styles')
    <link href="{{asset('assets/vendors/bower_components/datatables/media/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('main-section')
    <!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h5 class="panel-title txt-dark mb-30">
                            Contact List
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" >
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Name</th>
                                        <th>Contact Phone</th>
                                        <th>Contact Email</th>
                                        <th>Position</th>
                                        <th>Works At</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Contact Name</th>
                                        <th>Contact Phone</th>
                                        <th>Contact Email</th>
                                        <th>Position</th>
                                        <th>Works At</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($contacts as $c)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$c->contact_name}}</td>
                                            <td>{{$c->contact_phone}}</td>
                                            <td>{{$c->contact_email}}</td>
                                            <td>{{$c->position}}</td>
                                            <td>{{$c->site_name}}</td>
                                            <td>{{$c->province}}</td>
                                            <td>
                                                <a href="{{route('site_contacts' , ['id' => $c->site_id])}}" data-original-title="View Contacts" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a>
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


