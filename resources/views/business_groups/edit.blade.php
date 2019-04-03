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
                            Edit Business Retail Group
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="form-wrap">
                            <form action="{{route('business_group.update' , ['id' => $business_group->id])}}" method="post">
                                @csrf
                                @method('PUT')
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">--}}
                                            {{--<label class="control-label mb-10 text-left">Business Retail Group Name</label>--}}
                                            {{--<input type="text" class="form-control" name="name" id="name" value="{{ $business_group->name }}">--}}
                                            {{--@if ($errors->has('name'))--}}
                                                {{--<span class="text-danger" >--}}
                                                    {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}


                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group {{ $errors->has('ceo_name') ? 'has-error' : '' }}">--}}
                                            {{--<label class="control-label mb-10 text-left">CEO/Business Owners Name</label>--}}
                                            {{--<select name="ceo_name" id="ceo_name" class="form-control select2">--}}
                                                {{--@foreach($business_owners as $b)--}}
                                                    {{--<option value="{{$b->id}}">{{$b->name}}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                            {{--@if ($errors->has('ceo_name'))--}}
                                                {{--<span class="text-danger" >--}}
                                                    {{--<strong>{{ $errors->first('ceo_name') }}</strong>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}



                                    {{--<div class="col-md-4">--}}
                                        {{--<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">--}}
                                            {{--<label class="control-label mb-10 text-left">Status</label>--}}
                                            {{--<select name="status" class="form-control"  id="">--}}
                                                {{--@if($business_group->status == 0)--}}
                                                    {{--<option value="0" selected>Active</option>--}}
                                                    {{--<option value="1">Inactive</option>--}}
                                                {{--@else--}}
                                                    {{--<option value="0">Active</option>--}}
                                                    {{--<option value="1" selected>Inactive</option>--}}
                                                {{--@endif--}}
                                            {{--</select>--}}
                                            {{--@if ($errors->has('status'))--}}
                                                {{--<span class="text-danger" >--}}
                                                    {{--<strong>{{ $errors->first('status') }}</strong>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Business Retail Group Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$business_group->name}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('ceo_name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">CEO/Business Owners Name</label>
                                            <select name="ceo_name" id="ceo_name" class="form-control select2">
                                                @foreach($business_owners as $b)
                                                    <option value="{{$b->id}}"
                                                            @if($b->id == $business_group->business_owner_id)
                                                                selected
                                                            @endif
                                                    >{{$b->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('ceo_name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('ceo_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Contact Number</label>
                                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{$business_group->contact_number}}">
                                            @if ($errors->has('contact_number'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Email</label>
                                            <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{$business_group->contact_email}}">
                                            @if ($errors->has('status'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('contact_email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Address</label>
                                            <input type="text" class="form-control" name="address" id="address" value="{{$business_group->name}}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">City</label>
                                            <input type="text" class="form-control" name="city" id="city" value="{{$business_group->city}}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('province') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Province</label>
                                            <select name="province" class="form-control" id="province">
                                                @foreach($province as $p)
                                                    <option value="{{$p->name}}"
                                                            @if($p->name == $business_group->province)
                                                                selected
                                                            @endif
                                                    >{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('province'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('province') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('business_type') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Business Type</label>
                                            <select name="business_type" id="business_type" class="form-control select2">
                                                @if($business_group->business_type == "Individual")
                                                    <option value="Individual" selected>Individual</option>
                                                    <option value="Group">Group</option>
                                                @else
                                                    <option value="Individual">Individual</option>
                                                    <option value="Group" selected>Group</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('business_type'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('business_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Status</label>
                                            <select name="status" class="form-control"  id="">
                                                @if($business_group->status == 0)
                                                    <option value="0" selected>Active</option>
                                                    <option value="1">Inactive</option>
                                                @else
                                                    <option value="0">Active</option>
                                                    <option value="1" selected>Inactive</option>
                                                @endif
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-pencil-square"></span> Edit Business Retail Group Name</button>
                                            <a href="{{route('business_group.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        element: "#name",
                        title: "Business Retail Group Name",
                        content: "Use the field to update the name of the business retail group"
                    },
                    {
                        element: "#permission_id",
                        title: "Permission Type",
                        content: "Select permission type from the field list"
                    },
                    {
                        element: "#create_button",
                        title: "Update Permission",
                        content: "Use the button to update a new business retail group"
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