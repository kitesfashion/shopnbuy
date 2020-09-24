@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ url('/admin/update-customer-group') }}" method="POST" enctype="multipart/form-data" id="editForm" name="editForm">
        {{ csrf_field() }}
        <input type="hidden" name="customerGroupId" value="{{$customer_group->id}}">

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">
                <button type="submit" class="btn btn-outline-info btn-lg waves-effect">Update</button>
            </div>
        </div>

        <div class="form-group row {{ $errors->has('groupName') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger" placeholder="Group Name" name="groupName" value="{{ $customer_group->groupName }}" required>
                @if ($errors->has('groupName'))
                @foreach($errors->get('groupName') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('groupCode') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Code</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger" placeholder="Group Code" name="groupCode" value="{{ $customer_group->groupCode }}" required>
                @if ($errors->has('groupCode'))
                @foreach($errors->get('groupCode') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('metaTitle') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta Title</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger" placeholder="Meta Title" name="metaTitle" value="{{ $customer_group->metaTitle }}">
                @if ($errors->has('metaTitle'))
                @foreach($errors->get('metaTitle') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('metaKeyword') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta keyword</label>
            <div class="col-sm-7">
                <input type="text" class="form-control form-control-danger" placeholder="Meta Keyword" name="metaKeyword" value="{{ $customer_group->metaKeyword }}">
                @if ($errors->has('metaKeyword'))
                @foreach($errors->get('metaKeyword') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('description') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Meta description</label>
            <div class="col-sm-7">
                <textarea style="min-height: 100px;" class="form-control" name="metaDescription">{{ $customer_group->metaDescription }}</textarea>
                @if ($errors->has('metaDescription'))
                @foreach($errors->get('metaDescription') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('orderBy') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Order By</label>
            <div class="col-sm-7">
                <input type="number"   name="orderBy" value="{{ $customer_group->orderBy }}" required>
                @if ($errors->has('orderBy'))
                @foreach($errors->get('orderBy') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="form-group row {{ $errors->has('groupStatus') ? ' has-danger' : '' }}">
            <label class="col-sm-3 col-form-label">Publication status</label>
            <div class="col-sm-7 row">
                <div class="form-control">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="published" name="groupStatus" class="custom-control-input" value="1" required>
                        <label class="custom-control-label" for="published">Published</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="unpublished" name="groupStatus" class="custom-control-input" checked="" value="0">
                        <label class="custom-control-label" for="unpublished">Unpublished</label>
                    </div>
                </div>                            
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 m-b-20 text-right">
                <button type="submit" class="btn btn-outline-info btn-lg waves-effect">Update</button>
            </div>
        </div>              
    </form>
            
     <script type="text/javascript">
        document.forms['editForm'].elements['groupStatus'].value = "{{$customer_group->groupStatus}}";
    </script>

@endsection