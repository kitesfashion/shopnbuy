@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('userRole.update') }}" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
        {{ csrf_field() }}
        <input type="hidden" name="userroleId" value="{{$userRoles->id}}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('parentRole') ? ' has-danger' : '' }}">
                    <label>Select Parent</label>
                    <select class="form-control" name="parentRole">
                        <option value="">Select Parent</option>
                        @foreach($userRoleList as $role)
                        @php
                            if($role->id == $userRoles->parentRole){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }
                        @endphp
                            <option {{@$selected}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('parentRole'))
                    @foreach($errors->get('parentRole') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label>Name</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Name" name="name" value="{{ $userRoles->name }}" required>
                    @if ($errors->has('name'))
                    @foreach($errors->get('name') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
            </div>                              
        </div>                
    </form>
        
 <script type="text/javascript">
    document.forms['editUser'].elements['role'].value = "{{$userRoles->role}}";  
</script>

@endsection


