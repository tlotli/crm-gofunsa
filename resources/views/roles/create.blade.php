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
                            Add Role <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('roles.store')}}" method="post">
                                @csrf
                                @method('POST')
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Role Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label id="permission_type" class="control-label mb-10 text-left">Permissions For Users </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 1)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach

                                            @if ($errors->has('permission_id'))
                                                <span class="text-danger" >
                                                        <strong>{{ $errors->first('permission_id') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Roles </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 2)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Business Retail Groups </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 3)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Business Contacts </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 4)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Store Management </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 5)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Site Visitation </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 6)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Viewing Logs </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 12)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Stock Sold </label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 8)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Set Date Flag</label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 14)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Events</label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 10)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permissions For Franchises</label>
                                            @foreach($permissions as $p)
                                                @if($p->permission_type_id == 15)
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="{{$p->id}}" name="permission_id[]" value="{{$p->id}}" type="checkbox" >
                                                        <label for="{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-plus"></span> Create Role</button>
                                            <a href="{{route('roles.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        title: "Permission Name",
                        content: "Use the field to enter the name of the role"
                    },
                    {
                        element: "#permission_type",
                        title: "Permission Type",
                        content: "Use the checkboxes to assign permissions to users"
                    },
                    {
                        element: "#create_button",
                        title: "Create Permission",
                        content: "Use the button to create a new role"
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


