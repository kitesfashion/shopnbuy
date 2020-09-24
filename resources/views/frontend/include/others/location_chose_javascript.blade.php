<script type="text/javascript">
    $(".deliveryZone").change(function () {
        var delivery_zone_id = $('.deliveryZone').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'POST',
            url: "{{route('getArea')}}",
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

    $("#deliveryArea").change(function () {
       var delivery_zone_id = $('#deliveryZone').val(); 
       var delivery_zone_name = $("#deliveryZone option:selected").html();
       var delivery_area_id = $('#deliveryArea').val();
       var delivery_area_name = $("#deliveryArea option:selected").html();
       $.cookie("deliveryZoneId", delivery_zone_id);
       $.cookie("deliveryZoneName", delivery_zone_name);
       $.cookie("deliveryAreaId", delivery_area_id);
       $.cookie("deliveryAreaName", delivery_area_name);

       window.location.href = "{{route('home.index')}}";
    });

    $("#pushengage-overlay-close").click(function () {
       $('#pe-overlay-backdrop').hide();
    });

    function ChangeDeliveryZone(deliveryZoneId,deliveryZoneName){
        $.removeCookie('deliveryZoneId');
        $.removeCookie('deliveryZoneName');
        $.removeCookie('deliveryAreaId');
        $.removeCookie('deliveryAreaName');

        $.cookie("deliveryZoneId", deliveryZoneId);
        $.cookie("deliveryZoneName", deliveryZoneName);
        window.location.href = "{{URL::current()}}";
    }

    function LocationChooseDisplay(){
        if($.cookie('deliveryZoneId') === undefined && $.cookie('deliveryZoneName') === undefined &&$.cookie('deliveryAreaId') === undefined ){
            $('#pe-overlay-backdrop').css("display", "block");
            $.cookie("deliveryZoneId", '1');
            $.cookie("deliveryZoneName", 'Uttara');
            $('#currentDeliveryZone').text($.cookie("deliveryZoneName"));
        }else{
            $('#pe-overlay-backdrop').css("display", "none");
            $('#currentDeliveryZone').text($.cookie("deliveryZoneName"));
        }
    }

</script>
