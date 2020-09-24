@extends('admin.layouts.master')


@section('content')

    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
        {{ csrf_field() }}

        @if( count($errors) > 0 )
            
        <div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <div class="modal-body">
            <input type="hidden" name="userId" value="{{$users->id}}">

            <div class="form-group row {{ $errors->has('parent') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">User Role</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder="Name" name="name" value="{{ $userRoles->name }}" required readonly>
                    
                </div>
            </div>
            
            <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder="Name" name="name" value="{{ $users->name }}" required readonly>
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
                    <input type="email" class="form-control form-control-danger" placeholder="Email" name="email" value="{{ $users->email }}" required readonly>
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
                    <input type="text" class="form-control form-control-danger" placeholder="User Name" name="username" value="{{ $users->username }}" required readonly>
                    @if ($errors->has('username'))
                    @foreach($errors->get('username') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>                
    </form>
       
 <script type="text/javascript">
   
        document.forms['editUser'].elements['role'].value = "{{$users->role}}";
       

        
    </script>

@endsection


