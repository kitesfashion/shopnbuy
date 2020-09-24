@extends('admin.layouts.master')

@section('content')

    <form class="form-horizontal" action="{{ route('shippingCharge.update') }}" method="POST" enctype="multipart/form-data" id="form" name="form">
        {{ csrf_field() }}
        <input type="hidden" name="chargeId" value="{{$shipping_charges->id}}">
        <div class="col-md-12 m-b-20 text-right">    
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_zone_id') ? ' has-danger' : '' }}">
                    <label for="delivery_zone_id">Name</label>
                    <select class="form-control chosen-select deliveryZone" name="delivery_zone_id">
                        <option value="">Select Delivery Zone</option>
                        @php
                            foreach ($deliveryZoneList as $deliveryZone) {
                                if($deliveryZone->id == $shipping_charges->delivery_zone_id){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                        @endphp
                            <option {{@$selected}} value="{{$deliveryZone->id}}">{{$deliveryZone->name}}</option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group {{ $errors->has('delivery_area_id') ? ' has-danger' : '' }}">
                    <label for="delivery_area_id">Name</label>
                    <select class="form-control chosen-select deliveryArea" name="delivery_area_id" data-placeholder="Select Delivery Area">
                        <option value="">Select Delivery Area</option>
                       @php
                           foreach($deliveryAreaList as $deliveryArea){
                             if($deliveryArea->id == $shipping_charges->delivery_area_id){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                       @endphp
                            <option  {{@$selected}} value="{{$deliveryArea->id}}">{{$deliveryArea->name}}</option>
                        @php
                            }
                        @endphp
                    </select>
                </div>
            </div>
        </div>
       
       <div class="row">
           <div class="col-md-6">
               <div class="form-group {{ $errors->has('shippingCharge') ? ' has-danger' : '' }}">
                    <label for="shippingCharge">Shipping Charge</label>
                    <input type="text" class="form-control form-control-danger" placeholder="Shipping charge" name="shippingCharge" value="{{ $shipping_charges->shippingCharge }}" required>
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
                            <input type="radio" id="published" name="shippingStatus" class="custom-control-input" value="1" required>
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
            <button type="submit" class="btn btn-info waves-effect"><i class="fa fa-save"></i> UPDATE</button> 
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

<script type="text/javascript">
    document.forms['form'].elements['shippingStatus'].value = "{{$shipping_charges->shippingStatus}}";
</script>

@endsection
