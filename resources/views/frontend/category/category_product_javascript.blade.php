<script type="text/javascript">
  function ViewMore(){
    var productLimit = $('#productLimit').val();
    GetCategoryProduct(filterBy=null,sortingBy=null,sortingOrder=null,productLimit);
  }
  function ProductFilterBy(filterBy){
    GetCategoryProduct(filterBy,sortingBy=null,sortingOrder=null);
  }

  function ProductSortBy(sortingBy,sortingOrder){
    GetCategoryProduct(filterBy=null,sortingBy,sortingOrder);
  }
  function GetCategoryProduct(filterBy=null,sortingBy = null,sortingOrder = null,productLimit = null){
    var categoryId = $('.categoryId').val();
    if(categoryId){
      $('#loader').show();
    }
    $('#filterBy').val(filterBy);
    $('#sortingBy').val(sortingBy);
    $('#sortingOrder').val(sortingOrder);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    }); 
   $.ajax({
        type: "GET",
        url: '<?php echo url('get-category-product');?>/'+ categoryId,
        data : {
            filterBy:filterBy,
            sortingBy:sortingBy,
            sortingOrder:sortingOrder,
            productLimit:productLimit
        },
        success: function(response) {
          $('#categoryProductList').html(response.products);
          if(response.productLimit == response.totalProduct || response.productLimit > response.totalProduct){
            $('#viewMore').hide();
          }else{
            $('#productLimit').val(response.productLimit); 
          }
            setTimeout(function(){
             $('#loader').hide();
            }, 380);
        }
    });
  }

</script>