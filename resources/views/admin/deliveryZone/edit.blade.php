@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('deliveryZone.update') }}" method="POST" enctype="multipart/form-data" id="form" name="form">
        {{ csrf_field() }}
        <input type="hidden" name="deliveryZoneId" value="{{$deliveryZone->id}}">
       
        <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
            <label for="inputHorizontalDnger" class="col-sm-1 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-danger" placeholder="Delivery Zone name" name="name" value="{{ $deliveryZone->name }}" required>
                @if ($errors->has('name'))
                @foreach($errors->get('name') as $error)
                <div class="form-control-feedback">{{ $error }}</div>
                @endforeach
                @endif
            </div>

            <div class="col-sm-2">
                <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
            </div>
        </div>               
    </form>

@endsection

@section('custom-js')

<script type="text/javascript">
    document.forms['form'].elements['status'].value = "{{$deliveryZone->status}}";
</script>

@endsection