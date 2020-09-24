@extends('admin.layouts.master')

@section('content')
 <form class="form-horizontal" action="{{route('adminLogo.update')}}" method="POST" enctype="multipart/form-data" name="editlogos">
    {{ csrf_field() }}

    <div class="form-group row {{ $errors->has('adminTitle') ? ' has-danger' : '' }}">
           <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Admin Panel Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="adminTitle" value="{{@$logos->adminTitle}}" name="adminTitle" required>
                
                @if ($errors->has('adminTitle'))
                @foreach($errors->get('adminTitle') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

      <div class="form-group row {{ $errors->has('adminLogo') ? ' has-danger' : '' }}">
           <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Main Logo</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="adminLogo" aria-describedby="fileHelp" name="adminLogo">
                <img src="{{ asset('/').@$logos->adminLogo }}" style="width:75px;">
                @if ($errors->has('adminLogo'))
                @foreach($errors->get('adminLogo') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('adminsmalLogo') ? ' has-danger' : '' }}">
           <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Small Logo</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="adminsmalLogo" aria-describedby="fileHelp" name="adminsmalLogo">
                <img src="{{ asset('/').@$logos->adminsmalLogo }}" style="width:75px;">
                @if ($errors->has('adminsmalLogo'))
                @foreach($errors->get('adminsmalLogo') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('adminfavIcon') ? ' has-danger' : '' }}">
           <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Fav Icon</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="adminfavIcon" aria-describedby="fileHelp" name="adminfavIcon">
                <img src="{{ asset('/').@$logos->adminfavIcon }}" style="width:75px;">
                @if ($errors->has('adminfavIcon'))
                @foreach($errors->get('adminfavIcon') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <input type="hidden" name="adminLogoId" value="{{@$logos->id}}">

        <div class="col-md-11 m-b-20 text-right">    
            <button type="submit" class="btn btn-outline-info waves-effect">Update Information</button> 
        </div>
    </div>                
</form>

@endsection
