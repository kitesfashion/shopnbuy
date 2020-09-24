@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('area.save') }}" method="POST" enctype="multipart/form-data" id="form" name="form">
        {{ csrf_field() }}
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_zone_id') ? ' has-danger' : '' }}">
                    <label for="delivery_zone_id">Name</label>
                    <select class="form-control chosen-select" name="delivery_zone_id">
                        <option value="">Select Delivery Zone</option>
                        @php
                            foreach ($deliveryZoneList as $deliveryZone) {
                        @endphp
                            <option value="{{$deliveryZone->id}}">{{$deliveryZone->name}}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
               <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Menu name" name="name" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div> 
            </div>
        </div>                 
    </form>
@endsection
