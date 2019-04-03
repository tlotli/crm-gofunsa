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
                            Edit Permission <span ><a id="demo" data-demo=""  class="fa fa-question-circle-o"></a></span>
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="form-wrap">
                            <form action="{{route('permissions.update', ['id' => $permission->id ])}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permission Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $permission->name }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('permission_id') ? 'has-error' : '' }}">
                                            <label class="control-label mb-10 text-left">Permission Type </label>
                                            <select name="permission_id" id="permission_id" class="form-control">
                                                @foreach($permission_type as $p)
                                                    <option value="{{$p->id}}"
                                                            @if($permission->permission_type_id == $p->id)
                                                                selected
                                                            @endif
                                                    >{{$p->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('permission_id'))
                                                <span class="text-danger" >
                                                    <strong>{{ $errors->first('permission_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="create_button" class="btn btn-success mt-10"><span class="fa fa-pencil-square"></span> Edit Permission</button>
                                            <a href="{{route('permissions.index')}}" id="back" class="btn btn-primary mt-10"><span class="fa fa-arrow-left"></span> Back </a>
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
                        content: "Use the field to enter the name of the permission"
                    },
                    {
                        element: "#permission_id",
                        title: "Permission Type",
                        content: "Select permission type from the field list"
                    },
                    {
                        element: "#create_button",
                        title: "Create Permission",
                        content: "Use the button to create a new permission"
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