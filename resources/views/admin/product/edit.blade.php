@extends('admin.layouts.master')

@section('content')
    @php
        if(@$_GET['productAdvance']){
            $productAdvanceList = 'active';
            $productAdvanceSection = 'active show';
        }elseif(@$_GET['productSeo']){
            $productSeoList = 'active';
            $productSeoSection = 'active show';
        }else{
            $productBasicList = 'active';
            $productBasicSection = 'active show';
        }
    @endphp

    @php
        $productSections = array('1'=>'New Arrival','2'=>'Top Gadgets');
    @endphp

    <style type="text/css">
        .nav-item a:hover{
            border: none;
            height: 100%;
        }
    </style>
    <div class="card-pad"></div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" style="width: 98%;margin-left: 9px;background-color: #5d5d5b;">
        <li class="nav-item">
            <a class="nav-link {{@$productBasicList}}" data-toggle="tab" href="#basic_info" style="font-weight: bold;border-radius: 0px;">{{ $tab1 }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{@$productAdvanceList}}" data-toggle="tab" href="#advance_info" style="font-weight: bold;border-radius: 0px;">{{ $tab2 }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#image_info" style="font-weight: bold;border-radius: 0px;">{{ $tab3 }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{@$productSeoList}}" data-toggle="tab" href="#seo_info" style="font-weight: bold;border-radius: 0px;">{{ $tab4 }}</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="basic_info" class="container tab-pane {{@$productBasicSection}}">
            <div class="card-pad"></div>
            @include('admin/product/element/update/updateBasicInfo')
        </div>

        <div id="advance_info" class="container tab-pane fade {{@$productAdvanceSection}}">
            <div class="card-pad"></div>
            @include('admin/product/element/update/updateAdvanceInfo')
        </div>

        <div id="image_info" class="container tab-pane fade">
            <div class="card-pad"></div>
            @include('admin/product/element/update/updateImageInfo')
        </div>

        <div id="seo_info" class="container tab-pane fade {{@$productSeoSection}}">
            <div class="card-pad"></div>
            @include('admin/product/element/update/updateSeoInfo')
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
         if ($("#hotInput").is(":checked")){
            $("#hotDeal").show();
            $("#specialInput"). prop("checked", false);
            $("#specialDeal").hide();
        }else{
            $("#hotDeal").hide();
        }

        if ($("#specialInput").is(":checked")){
            $("#specialDeal").show();
            $("#hotInput"). prop("checked", false);
            $("#hotDeal").hide();
        }else{
            $("#specialDeal").hide();
        }

        $(function(){
            $("#hotInput").click(function(){
                if ($(this).is(":checked")){
                    $("#hotDeal").show();
                    $("#specialInput"). prop("checked", false);
                    $("#specialDeal").hide();
                    $("#specialDeal").hide();
                    $("input[name='specialDiscount']").val('');
                    $("input[name='specialDate']").val('');
                }
                else
                {
                    $("#hotDeal").hide();
                }
            });
        });

        $(function(){
            $("#specialInput").click(function(){
                if ($(this).is(":checked")){
                    $("#specialDeal").show();
                    $("#hotInput"). prop("checked", false);
                    $("#hotDeal").hide();
                    $("input[name='hotDiscount']").val('');
                    $("input[name='hotDate']").val('');
                }
                else
                {
                    $("#specialDeal").hide();
                }
            });
        });

        function findMrpHairePrice()
        {
            if ($("#price").val() == "")
            {
                var price = 0
            }
            else
            {
                var price = parseFloat($("#price").val());
            }

            var mrpPrice = price + (price * 8)/100;
            var hairePrice = mrpPrice + (mrpPrice * 12)/100;
            $("#mrpPrice").val(mrpPrice.toFixed(2));
            $("#hairePrice").val(hairePrice.toFixed(2));
        }
    </script>

    <script type="text/javascript">
         $(document).ready(function() {              
                var updateThis ;
                //ajax upload image
                $( "form[name='image-form']" ).on( "submit", function( event ) {
                    $('.has-danger').removeClass('has-danger');
                    var formData = new FormData(this);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('productImage.save') }}",
                        data:formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            var images = response.images;
                            swal({
                                title: "<small class='text-success'>Success!</small>", 
                                type: "success",
                                text: "Image Successfully Uploded!",
                                timer: 2000,
                                html: true,
                            });
                            $('#images').html(images);
                        },
                        error: function(response) {

                        }
                    });
                    $("#image-form")[0].reset();
                });
            });

            //ajax remove image
            function removeImage(imageId)
            {
                // e.preventDefault();

                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                },

                function(isConfirm){
                    if (isConfirm) {                    
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type : 'POST',
                            url: "{{ route('productImage.delete') }}",
                            data : {imageId : imageId},
                            success : function(response){
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Image deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.card_image_'+imageId).remove();
                            }
                        })

                    }else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your Image is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    }
                });
            }
    </script>

    <script type="text/javascript">
        $(".add_customer_group").click(function () {
            var group_count = $('.group_count').val();
            var total = parseInt(group_count) + 1; 
            $(".customerGroupRow").append(
                '<div class="row extraGroup extra_group_'+total+'"><div class="col-md-6">'+
                '<select name="customerGroupId[]" data-placeholder="Select Group" class="form-control chosen-select customerGroupOption_'+total+'">'+
                '</select>'+
                '</div>'+
                '<div class="col-md-6">'+
                '<span class="cnt_remove"><i class="fa fa-times" onclick="mychar(' + total + ')"></i>'+
                '<input type="text" name="customerGroupPrice[]" class="form-control" placeholder="price for customer group" value=""></span>'+ 

                '</div></div>'
                );

            $('.group_count').val(total);
            var extra_group = $("#customer_group div select").html();
            $('.customerGroupOption_'+total).html(extra_group);
            $('.chosen-select').chosen();
            $('.chosen-select').trigger("chosen:updated");
        });

        function mychar(i) {
            $(".extra_group_" + i).remove();
        }        
    </script>

    <style type="text/css">
        .extraGroup{
            margin-top: 5px !important;
        }

        .cnt_remove {
            width: 100%;
            position:  relative;
            top: 0;
            right: 0;
            display: inline-block;
        }
        .cnt_remove i {
            position:  absolute;
            top: -7px;
            right: -10px;
            z-index: 9;
            display: none;
            cursor: pointer;
            display: block;
        }

        .cnt_remove:hover i {
            display: block;
        }
    </style>
@endsection