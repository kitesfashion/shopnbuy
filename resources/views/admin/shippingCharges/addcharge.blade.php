@extends('admin.layouts.master')

@section('content')

    <form class="form-horizontal" action="{{ route('shippingCharge.save') }}" method="POST" enctype="multipart/form-data" id="newProduct" name="newProduct">
        {{ csrf_field() }}
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_zone_id') ? ' has-danger' : '' }}">
                    <label for="delivery_zone_id">Name</label>
                    <select class="form-control chosen-select deliveryZone" name="delivery_zone_id">
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
                <div class="form-group {{ $errors->has('delivery_area_id') ? ' has-danger' : '' }}">
                    <label for="delivery_area_id">Name</label>
                    <select class="form-control chosen-select deliveryArea" name="delivery_area_id" data-placeholder="Select Delivery Area">
                       
                    </select>
                </div>
            </div>
        </div>
       
       <div class="row">
           <div class="col-md-6">
               <div class="form-group {{ $errors->has('shippingCharge') ? ' has-danger' : '' }}">
                    <label for="shippingCharge">Shipping Charge</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Shipping charge" name="shippingCharge" value="{{ old('shippingCharge') }}" required>
                    @if ($errors->has('shippingCharge'))
                        @foreach($errors->get('shippingCharge') as $error)
                            <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
           </div>

           <div class="col-md-6">
                <label>Publication status</label>
                <div class="form-group {{ $errors->has('shippingStatus') ? ' has-danger' : '' }}">
                    <div class="form-control">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="published" name="shippingStatus" class="custom-control-input" checked="" value="1" required>
                            <label class="custom-control-label" for="published">Published</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="unpublished" name="shippingStatus" class="custom-control-input" value="0">
                            <label class="custom-control-label" for="unpublished">Unpublished</label>
                        </div>
                    </div> 
                </div>
            </div>
       </div>

        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> SAVE</button> 
        </div>              
    </form>
@endsection

@section('custom-js')

<script type="text/javascript">
    $(".deliveryZone").change(function () {
        var delivery_zone_id = $('.deliveryZone').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url: "{{route('getDeliveryArea')}}",
            data : {
                delivery_zone_id : delivery_zone_id,
            },
            success : function(data){
                $('.deliveryArea').html(data.area);
                $('.chosen-select').chosen();
                $('.chosen-select').trigger("chosen:updated");
            }
        })
    });

</script>

@endsection
