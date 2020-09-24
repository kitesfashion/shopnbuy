@extends('admin.layouts.master')

@section('content')
        <form class="form-horizontal" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="editUser" name="editUser">
            {{ csrf_field() }}
            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect">
                    <i class="fa fa-save"></i> UPDATE
                </button>
            </div>
            <br>
            <input type="hidden" name="userId" value="{{@$users->id}}">
            <input type="hidden" name="userAccount" value="userAccount">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-danger" placeholder="Name" name="name" value="{{ @$users->name }}" required>
                        @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control form-control-danger" placeholder="Name" name="email" value="{{ @$users->email }}" required>
                        @if ($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('username') ? ' has-danger' : '' }}">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control form-control-danger" placeholder="User Name" name="username" value="{{ @$users->username }}" required>
                        @if ($errors->has('username'))
                            @foreach($errors->get('username') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div> 
                </div>

                <div class="col-md-6">
                    <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-danger" placeholder="User Name" name="password" value="{{ @$users->password }}" required>
                        @if ($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div> 
                </div>
            </div>
              
        </form>
        
     <script type="text/javascript">
       
            document.forms['editUser'].elements['role'].value = "{{@$users->role}}";
            document.forms['editUser'].elements['delivery_zone_id'].value = "{{@$users->delivery_zone_id}}";
    </script>

@endsection


