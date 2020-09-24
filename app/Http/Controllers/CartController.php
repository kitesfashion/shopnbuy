<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

use Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.carts.cart');
    } 
 
    public function addCart(Request $request){
        $image = ProductImage::where('productId',@$request->productId)->first();
        $products = Product::where('id',@$request->productId)->first();

        if ($products->discount) {
            $price = $products->discount;
        }else{
            $price = $request->productPrice;
        }

        Cart::add(['id' => $request->productId, 
            'name' => $request->productName, 
            'qty' => $request->productQuantity, 
            'price' => $price, 
            'options' => ['image' => $image->images, 
            'deal_code' => $products->deal_code]]);
        return redirect(route('cart.index'));
    } 

    public function remove($rowId, Request $request)
    {  
        if($request->ajax())
        {
            Cart::remove($rowId);
            print_r(1);       
            return;
        }
       
    }

    public function update(Request $request)
    {   
        if($request->ajax())
        {
            Cart::update($request->rowId, $request->qty);
            print_r(1);       
            return;
        }
    }

    public function addItem($id,$price){
        $products = Product::where('id',$id)->first(); // get prodcut by id
        $image = ProductImage::where('productId',@$id)->where('section','content')->first();
        $cart =  Cart::add(['id' => $products->id, 
            'name' => $products->name, 
            'qty' => 1, 
            'price' => $price, 
            'options' => ['image' => $image->images, 
            'deal_code' => $products->deal_code]]);
            $subtotal = Cart::subtotal();
            $total = str_replace(',', '', $subtotal);
            
        return response()->json([
            'total'=>$total
        ]);
    }

    public function addItemFromSingleProduct($id,$quantity){
       /* $products = Product::where('id',$id)->first();
        $image = ProductImage::where('productId',@$id)->first();

        if (@$products->discount) {
            $price = $products->discount;
        }else{
            $price = $products->price;
        }

        $cart =  Cart::add(['id' => $products->id, 
            'name' => $products->name, 
            'qty' => $quantity, 
            'price' => $price, 
            'options' => ['image' => $image->images, 
            'deal_code' => $product->deal_code]]);
            $subtotal = Cart::subtotal();
            $total = str_replace(',', '', $subtotal); 
            
        return response()->json([
            'total'=>$total
        ]);*/
    }

    //Show Product number in cart
    public function cartItem(Request $request){
        $carts =  Cart::count();
        if($request->ajax())
            {
                return response()->json([
                    'carts'=>$carts
                ]);
            }
    }
    
    //Show each product in mini cart
    public function minicartProduct(Request $request){
        $data = "";
        $total = 0;
        if(Cart::count() > 0){
            foreach(Cart::content() as $carts)
            {
                $name = str_replace(' ', '-', $carts->name);
                if(file_exists($carts->options->image)){
                    $image = asset(@$carts->options->image);
                }else{
                    $image = asset('/public/frontend/no-image-icon.png');
                }

                $data .='<div _ngcontent-c5="" class="card m-1 p-1 parentRow_'.$carts->rowId.'">';
                $data .='<span _ngcontent-c5="" class="remove_product" onclick="removeCartRow('."'".$carts->rowId."'".')">';
                $data .='<span _ngcontent-c5="" class="remove_item">X</span>';
                $data .='</span>';
                $data .='<div _ngcontent-c5="" class="d-flex align-items-center">';
                $data .='<img _ngcontent-c5="" src="'.$image.'">';
                $data .='<div _ngcontent-c5="" class="cart-calc">';
                $data .='<p _ngcontent-c5="">'.str_limit($carts->name,50).'</p>';
                $data .='<p _ngcontent-c5="">'.$carts->options->deal_code.'</p>';
                $data .='<div _ngcontent-c5="">';
                $data .='<p _ngcontent-c5="">৳ '.$carts->price.'</p>';
                $data .='<div _ngcontent-c5="" class="quantity">';
                $data .='<span _ngcontent-c5="" id="multiply">X</span>';
                $data .='<button _ngcontent-c5="" class="btn decreaseProduct" onclick="UpdateShoppingCart('."'".$carts->rowId."'".","."'"."minus"."'".')"> - </button>';
                $data .='<span _ngcontent-c5="" id="inputQty_'.$carts->rowId.'">'.$carts->qty.'</span>';
                $data .='<button _ngcontent-c5="" class="btn increaseProduct" onclick="UpdateShoppingCart('."'".$carts->rowId."'".","."'"."plus"."'".')"> + </button>';
                $data .='</div>';
                $data .='</div>';
                $data .='</div>';
                $data .='</div>';
                $data .='<div _ngcontent-c5="" class="sub-total">';
                $data .='<p _ngcontent-c5="">৳ '.$carts->subtotal.'</p>';
                $data .='</div>';
                $data .='</div>';

                $total += $carts->subtotal;
            }
            $data .='<div _ngcontent-c5="" class="cart-footer">';
            $data .='<div _ngcontent-c5="" class="cart-footer-count">';
            $data .='<span _ngcontent-c5="" class="cart-quantity">';
            $data .='<i _ngcontent-c5="" aria-hidden="true" class="fa fa-shopping-cart"></i>';
            $data .=' '.Cart::count().' Item</span>';
            $data .='<span _ngcontent-c5="" class="cart-total">';
            $data .='Total : <span _ngcontent-c5="" class="cart-total-amount">'.$total.'</span>';
            $data .='</span>';
            $data .='</div>';
            $data .='<a href="'.route('cart.order').'">';
            $data .='<div _ngcontent-c5="" class="footer-checkout">';
            $data .='<span _ngcontent-c5="">';
            $data .='<i _ngcontent-c5="" aria-hidden="true" class="fa fa-shopping-cart">';
            $data .='</i> CHECKOUT';
            $data .='</span>';
            $data .='</div>';
            $data .='</a>';
            $data .='</div>';
        }else{
            $data .='<div _ngcontent-c5="" class="cart-content">';
            $data .='<div _ngcontent-c5="" class="empty-cart">';
            $data .='<h3 _ngcontent-c5="">';
            $data .='ADD ITEM/S TO YOUR CART';
            $data .='</h3>';
            $data .='</div>';
            $data .='</div>';
        }

        echo $data;

    }

     //Show each product in main cart page
    public function MainCartProduct(Request $request){
        /*$data = "";
        $totalSummary = "";
        if(Cart::count() < 1){
            $disabled = "disabled";
        }else{
            $disabled = "";
        }
            if(Cart::count() > 0){
                $data .='<ul class="cart-items">';
                foreach(Cart::content() as $cart)
                {
                    $name = str_replace(' ', '-', $cart->name);
                    $products = Product::where('id',$cart->id)->first();
                    if(file_exists($cart->options->image))
                    {
                        $image = asset('/'.@$cart->options->image);
                    }
                    else
                    {
                        $image = asset('/public/frontend/no-image-icon.png');
                    }

                    $data .='<li class="cart-item parentRow_'.$cart->rowId.'">';
                    $data .='<div class="product-line-grid">';
                    $data .='<input type="hidden" name="rowId" class="rowId_'.$cart->rowId.'" value="'.$cart->rowId.'">';
                    $data .='<div class="product-line-grid-left col-md-2 col-xs-4">';
                    $data .='<span class="product-image media-middle">';
                    $data .='<img src="'.$image.'" style="height:100px;width:100px;">';
                    $data .='</span>';
                    $data .='</div>';
                    $data .='<div class="product-line-grid-body col-md-5 col-xs-8">';
                    $data .='<div class="product-line-info product-title">';
                    $data .='<a class="label" href="'.url('product/'.@$cart->id.'/'.@$name).'" data-id_customization="0">'.$cart->name.'</a>';
                    $data .='</div>';
                    $data .='<div class="product-line-info product-attributes">';
                    $data .='<span class="label">Code:</span>';
                    $data .='<span class="value">'.$products->deal_code.'</span>';
                    $data .='</div>';
                    $data .='<div class="product-line-info product-attributes">';
                    $data .='<span class="label">Quantity:</span>';
                    $data .='<span class="value">'.$cart->qty.'</span>';
                    $data .='</div>';
                    $data .='<div class="product-line-info product-price has-discount">';
                    $data .='<div class="current-price">';
                    $data .='<span class="product-price">৳ '.$cart->price.'</span>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='<div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">';
                    $data .='<div class="row">';
                    $data .='<div class="col-xs-4 hidden-md-up"></div>';
                    $data .='<div class="col-md-10 col-xs-6">';
                    $data .='<div class="row">';
                    $data .='<div class="col-md-6 col-xs-6 qty">';
                    $data .='<div class="input-group bootstrap-touchspin">';
                    $data .='<input id="inputQty_'.$cart->rowId.'" type="number" min="1" name="quantity" value="'.$cart->qty.'" oninput="UpdateShoppingCart('."'".$cart->rowId."'".')" style="width: 80px;" />';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='<div class="col-md-6 col-xs-2 price">';
                    $data .='<span class="product-price">';
                    $data .='<strong>৳ '.$cart->subtotal.'</strong>';
                    $data .='</span>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='<div class="col-md-2 col-xs-2 text-xs-right">';
                    $data .='<div class="cart-line-product-actions">';
                    $data .='<a href="javascript:void(0)" class="remove-from-cart" rel="nofollow" href="" onclick="removeCartRow('."'".$cart->rowId ."'".')">';
                    $data .='<i class="material-icons float-xs-left">delete</i>';
                    $data .='</a>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='</div>';
                    $data .='<div class="clearfix"></div>';
                    $data .='</div>';
                    $data .='</li>';
                }
                $data .='</ul>';
                
            }else{
                $data .='<span class="no-items">There are no more items in your cart</span>';
            }

            $totalSummary .= '<div class="cart-detailed-totals">';
            $totalSummary .= '<div class="card-block">';
            $totalSummary .= '<div class="cart-summary-line" id="cart-subtotal-products">';
            $totalSummary .= '<span class="label js-subtotal">';
            $totalSummary .= Cart::count().' items';
            $totalSummary .= '</span>';
            $totalSummary .= '<span class="value">';
            $totalSummary .= '৳ '.Cart::subtotal();
            $totalSummary .= '</span>';
            $totalSummary .= '</div>';
            $totalSummary .= '</div>';
            $totalSummary .= '<div class="card-block cart-summary-totals">';
            $totalSummary .= '<div class="cart-summary-line">';
            $totalSummary .= '<span class="label">Total&nbsp;</span>';
            $totalSummary .= '<span class="value"> ৳ '.Cart::subtotal().'</span>';
            $totalSummary .= '</div>';
            $totalSummary .= '</div>';
            $totalSummary .= '</div>';
            $totalSummary .= '<div class="checkout cart-detailed-actions card-block">';
            $totalSummary .= '<div class="text-sm-center">';
            $totalSummary .= '<a href="'.route('cart.checkout').'" class="btn btn-primary '.$disabled.'">Proceed to checkout</a>';
            $totalSummary .= '</div>';
            $totalSummary .= '</div>';

            return response()->json([
                    'cartProduct'=>$data,
                    'cartSummary'=>$totalSummary
                ]);*/

        }
        
}
