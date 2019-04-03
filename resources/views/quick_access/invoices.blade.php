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
                            Invoice List
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
                                        <th>Issued By</th>
                                        <th>Date Invoiced</th>
                                        <th>Invoice Attachment</th>
                                        <th>Status </th>
                                        <th>Quantity Ordered</th>
                                        <th>Site Name</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Issued By</th>
                                        <th>Date Invoiced</th>
                                        <th>Invoice Attachment</th>
                                        <th>Status </th>
                                        <th>Quantity Ordered</th>
                                        <th>Site Name</th>
                                        <th>Province</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($invoices as $i)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{$i->who_invoiced}}</td>
                                            <td>{{$i->date_invoiced }}</td>
                                            <td>
                                                @if($i->invoice_attachment != '')
                                                    <a href="{{ Storage::disk('local')->url($i->invoice_attachment) }}"  title="" data-original-title="View Attachement" data-toggle="tooltip"> <span class="fa fa-file-o"></span></a></td>
                                                @endif
                                            <td>
                                                @if($i->status == 0)
                                                    Invoiced
                                                @else
                                                    Not Invoiced
                                                @endif
                                            </td>
                                            <td>{{$i->quantity}}</td>
                                            <td>{{$i->site_name}}</td>
                                            <td>{{$i->province}}</td>
                                            <td>
                                                <a href="{{route('invoices.index' , ['id' => $i->site_id])}}" data-original-title="View Invoices" data-toggle="tooltip"> <span style="margin-left: 10px" class="  fa fa-eye"></span></a>
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