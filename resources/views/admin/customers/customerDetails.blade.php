@extends('admin.layouts.master')

@section('content')

<style type="text/css">
    .search-choice{
    width: auto;
    display: inline-block;
    }
    .chosen-container { width: 100% !important }
</style>
 <form class="form-horizontal" action="{{ route('update.clientGroup') }}" method="POST" enctype="multipart/form-data" id="customerForm" name="customerForm">
    {{ csrf_field() }}
    <div class="col-md-12 m-b-20 text-right">    
        <button type="submit" class="btn btn-info waves-effect">Save</button> 
    </div>
   
    <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Customer Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger"  name="name" value="{{ $customers->name }}" readonly>
            @if ($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

      <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Email Address</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger"  name="name" value="{{ $customers->email }}" readonly>
            @if ($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

      <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Phone No</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger"  name="name" value="{{ $customers->mobile }}" readonly>
            @if ($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

      <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-9">
            <input type="text" class="form-control form-control-danger" name="name" value="{{ $customers->address }}" readonly>
            @if ($errors->has('name'))
            @foreach($errors->get('name') as $error)
            <div class="form-control-feedback">{{ $error }}</div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('clientGroup') ? ' has-danger' : '' }}">
        <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Add to Group</label>
        <div class="col-sm-9">
           <select name="clientGroup[]" data-placeholder="Choose any Group" class="form-control chosen-select" multiple tabindex="4">
        <?php $customer_group = explode(',', @$customers->clientGroup); ?>
           @foreach($customer_groups as $group)
                <?php
                    if (in_array($group->id, $customer_group)){
                       $selected = "selected";
                    }else{
                        $selected = "";
                    }
                ?>
                    <option {{$selected}} value="{{ $group->id }}">{{ $group->groupName }}</option>
             @endforeach

            </select>
        </div>
    </div>

    <input type="hidden" name="customerId" value="{{$customers->id}}">         
</form>
<style type="text/css">
    select{
        cursor: pointer;
    }
    
</style>

     <script type="text/javascript">
        document.forms['customerForm'].elements['clientGroup'].value = "{{$customers->clientGroup}}";

        
    </script>

@endsection