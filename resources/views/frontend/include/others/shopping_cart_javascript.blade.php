<script>
var fadeTime = 0;

$(document).ready(function(){
  $(".cart-toggling").click(function(){
    ShowCartBlock();
  });

  $("#hideCartBlock").click(function(){
    HideCartBlock();
  });
});

//add cart
function addCart(productId,price){
  $.ajax({
    type: 'get',
    url: '<?php echo url('/cart/addItem');?>/'+ productId+'/'+price,
    dataType: "JSON",
    success: function(response) {
      ShowCartBlock();
      itemcount();
      minicartProduct();
    }
    
  });
};

  //add cart from single product page
  function addCartFromSingleProduct(productId){
    var quantity =  $('#quantity_wanted').val();
      $.ajax({
      type: 'get',
      url: '<?php echo url('/cart/addItemFromSingleProduct');?>/'+ productId+'/'+quantity,
      dataType: "JSON",
      success: function(response) {

        itemcount();
        minicartProduct();
        
      }
    });
  };

  function UpdateShoppingCart(rowId,increase_decrease){
    var inputQty = $('#inputQty_'+rowId).html();
    if(increase_decrease == 'plus'){
      var qty = parseInt(inputQty) + parseInt(1);
    }else if(increase_decrease == 'minus'){
      var qty = parseInt(inputQty) - parseInt(1);
    }
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type: "POST",
        url: "{{ route('carts.update') }}",
        dataType: "JSON",
        data: {
            rowId:rowId,
            qty:qty,
        },
        success: function(response) {
          minicartProduct();
          itemcount();
        },
    });
  }


 //remove from mini cart
    function removeCartRow(rowsId){
        $.ajax({
            type: "GET",
            url: "{!! url('carts') !!}" + "/" + rowsId+"/remove",
            dataType: "JSON",
            cache:false,
            contentType: false,
            processData: false,
            success: function(response) {
              itemcount();
              minicartProduct();
            },
            error: function(response) {  
            }
        });
      };
     
      function minicartProduct(){
        $.ajax({
                type: "GET",
                url: '<?php echo url('/cart/minicartProduct');?>',
                data:{},
                success:function(response){
                 $('#minicartProduct').html(response);
                }
            })
        }

      function MainCartProduct(){
        $.ajax({
          type: "GET",
          url: '<?php echo url('/cart/mainCartProduct');?>',
          data:{},
          success:function(response){
           $('#cartProduct').html(response.cartProduct);
           $('#cartSummary').html(response.cartSummary);
          }
        })
      }

    //subtotal for cart item
    function itemcount(){
      $.ajax({
        type: "GET",
        url: '<?php echo url('/cart/item');?>',
        data:{},
        success:function(response){
          var data = response.carts;
          $('.cart_count').text(data);
        }
      })
    }

  function ShowCartBlock(){
    $(".cartBlock").addClass("show_cart_block");
  }

  function HideCartBlock(){
    $(".cartBlock").removeClass("show_cart_block");
  }
</script>

