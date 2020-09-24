@extends('admin.layouts.master')

@section('content')
        <form class="form-horizontal" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
            {{ csrf_field() }}
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect">Update</button> 
            </div>
            <br>
            <input type="hidden" name="userId" value="{{@$users->id}}">

            <div class="form-group row {{ $errors->has('delivery_zone_id') ? ' has-danger' : '' }}">
                <label for="delivery_zone_id" class="col-sm-3 col-form-label"> Delivery Zone</label>
                <div class="col-sm-9">
                    <select class="form-control" name="delivery_zone_id">
                        <option value=""> Select Delivery Zone</option>
                        @foreach($deliveryZoneList as $deliveryZone)
                            <option value="{{$deliveryZone->id}}">{{$deliveryZone->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('delivery_zone_id'))
                    @foreach($errors->get('delivery_zone_id') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('parent') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Select Role</label>
                <div class="col-sm-9">
                    <select class="form-control" name="role" required>
                        <option value=""> Select Role</option>
                        @foreach($userRoles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('parent'))
                    @foreach($errors->get('parent') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>
            
            <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder="Name" name="name" value="{{ @$users->name }}" required>
                    @if ($errors->has('name'))
                    @foreach($errors->get('name') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('email') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control form-control-danger" placeholder="Email" name="email" value="{{ @$users->email }}" required>
                    @if ($errors->has('email'))
                    @foreach($errors->get('email') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('username') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">User Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder="User Name" name="username" value="{{ @$users->username }}" required>
                    @if ($errors->has('username'))
                    @foreach($errors->get('username') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>               
        </form>
        
     <script type="text/javascript">
       
            document.forms['editUser'].elements['role'].value = "{{@$users->role}}";
            document.forms['editUser'].elements['delivery_zone_id'].value = "{{@$users->delivery_zone_id}}";
    </script>

@endsection


