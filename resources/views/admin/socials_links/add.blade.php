@extends('admin.layouts.master')

@section('content')
<form class="form-horizontal" action="{{ route('social.add') }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
        {{ csrf_field() }}

        @if( count($errors) > 0 )
            
        <div style="display:inline-block;width: auto;" class="alert alert-danger">{{ $errors->first() }}</div>
        
        @endif
        <div class="modal-body">
            <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder="name" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    @foreach($errors->get('name') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('icon') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Social Icon</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder='<i class="fa fa-facebook"></i>' name="icon" value="{{ old('icon') }}" required>
                    @if ($errors->has('icon'))
                    @foreach($errors->get('icon') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group row {{ $errors->has('link') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Social Link</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-danger" placeholder='www.address.com' name="link" value="{{ old('link') }}" required>
                    @if ($errors->has('link'))
                    @foreach($errors->get('link') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>

             <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
                <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Order By</label>
                <div class="col-sm-9">
                    <input type="number" name="orderBy" value="{{ old('orderBy') }}" required>
                    @if ($errors->has('orderBy'))
                    @foreach($errors->get('orderBy') as $error)
                    <div class="form-control-feedback">{{ $error }}</div>
                    @endforeach
                    @endif
                </div>
            </div>
            
            <div class="form-group row {{ $errors->has('status') ? ' has-danger' : '' }}">
                <label class="col-sm-3 col-form-label">Publication status</label>
                <div class="col-sm-9 row">
                    <div class="form-control">
                        <div>
                            <input type="radio" name="status" value="1" checked required>
                            <label for="published">Published</label>
                        </div>
                        <div>
                            <input type="radio" name="status" value="0">
                            <label for="unpublished">Unpublished</label>
                        </div>
                    </div>                            
                </div>
            </div>

            <div class="col-md-12 m-b-20 text-right">    
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
            </div>
            
        </div>                
</form>
@endsection

