@extends('admin.layouts.master')

@section('content')
    <form class="form-horizontal" action="{{ route('area.update') }}" method="POST" enctype="multipart/form-data" id="form" name="form">
        {{ csrf_field() }}
        <input type="hidden" name="areaId" value="{{$area->id}}">
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_zone_id') ? ' has-danger' : '' }}">
                    <label for="delivery_zone_id">Delivery Zone</label> 
                    <select class="form-control chosen-select" name="delivery_zone_id">
                        @php
                            foreach ($deliveryZoneList as $deliveryZone) {
                                if($deliveryZone->id == $area->delivery_zone_id){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                        @endphp
                            <option {{@$selected}} value="{{$deliveryZone->id}}">
                                {{$deliveryZone->name}}
                            </option>
                       @php
                           }
                       @endphp
                    </select>
                </div>
            </div>

            <div class="col-md-6">
               <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Menu name" name="name" value="{{ $area->name }}" required>
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
