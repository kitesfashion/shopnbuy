<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Cart;
use Session;
use DB;
use PDF;

use App\Order;
use App\OrderList;
use App\Customer;
use App\Product;

class OrderController extends Controller{
    public function OrderProcessing(){
        $title = "Order Processing";
        return view('frontend.shopping_cart.order_processing')->with(compact('title'));
    }


    public function OrderSuccess(){
        $title = "Order Success";
        return view('frontend.shopping_cart.ordersuccess')->with(compact('title'));
    }

    public function OrderSave(Request $request){
        $customerId = Session::get('customerId');

        /*$post_data = array();
        $post_data['store_id'] = "impor5e5cb2ebac235";
        $post_data['store_passwd'] = "impor5e5cb2ebac235@ssl";
        $post_data['total_amount'] = $request->total_amount;
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
        $post_data['success_url'] = route('order.success');
        $post_data['fail_url'] = "http://localhost/new_sslcz_gw/fail.php";
        $post_data['cancel_url'] = "http://localhost/new_sslcz_gw/cancel.php";
        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

        # EMI INFO
        $post_data['emi_option'] = "1";
        $post_data['emi_max_inst_option'] = "9";
        $post_data['emi_selected_inst'] = "9";

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = "Dhaka";
        $post_data['cus_add2'] = "Dhaka";
        $post_data['cus_city'] = "Dhaka";
        $post_data['cus_state'] = "Dhaka";
        $post_data['cus_postcode'] = "1000";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = "01711111111";
        $post_data['cus_fax'] = "01711111111";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "testimporc213";
        $post_data['ship_add1 '] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_country'] = "Bangladesh";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b '] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        # CART PARAMETERS
        $post_data['cart'] = json_encode(array(
            array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
            array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
        ));
        $post_data['product_amount'] = "100";
        $post_data['vat'] = "5";
        $post_data['discount_amount'] = "5";
        $post_data['convenience_fee'] = "3";

        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, 1 );
        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


        $content = curl_exec($handle );

        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if($code == 200 && !( curl_errno($handle))) {
            curl_close( $handle);
            $sslcommerzResponse = $content;
        } else {
            curl_close( $handle);
            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
            exit;
        }

        # PARSE THE JSON RESPONSE
        $sslcz = json_decode($sslcommerzResponse, true );

        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
            # header("Location: ". $sslcz['GatewayPageURL']);
            exit;
        } else {
            echo "JSON Data parsing error!";
        }*/

        if($request->email){
            $existCustomer = Customer::where('email',$request->email)->orWhere('mobile',$request->phone)->first();    
        }else{
            $existCustomer = Customer::where('mobile',$request->phone)->first();
        }
        
        if($existCustomer){
            $customer = Customer::find($existCustomer->id);
            $customer->update( [
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,         
            ]);
        }else{
            $customer = Customer::create([
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,
            ]);
        } 

        $order = Order::create([
            'customer_id'=>$customer->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'shipping_address'=>$request->shipping_address,
            'delivery_zone_id'=>@$request->delivery_zone_id,
            'delivery_zone_name'=>@$request->delivery_zone_name,
            'shipping_location_id'=>@$request->shipping_location_id,
            'shipping_location_name'=>@$request->shipping_location_name,
            'shipping_charge'=>$request->shipping_charge,
            'payment_method'=>$request->payment_method,
            'total_amount'=>str_replace(',', '', $request->total_amount),
            'status'=>'Waiting',
        ]);
        
        $total = 0;

        foreach(Cart::content() as $cart){
            $product=Product::find($cart->id);
            $orderList = OrderList::create([
                'order_id'=>$order->id,
                'customer_id'=>$customer->id,
                'product_id'=>$product->id,
                'name'=>$product->name,
                'code'=>$product->deal_code,
                'qty'=>$cart->qty,
                'price'=>$cart->price,
                'total'=>$cart->qty*$cart->price,
                'delivery_zone_id'=>@$request->delivery_zone_id,
                'delivery_zone_name'=>@$request->delivery_zone_name,
                'status'=>'',
            ]);
        }
        Cart::destroy();
        $title = "Order Success";
        return view('frontend.shopping_cart.ordersuccess')->with(compact('title'));
      
    }

    /*public function OrderSave(Request $request){*/
        /* 
           $this->validate(request(), [
                'fullName' => 'required|string|max:100',
                'email' => 'nullable|string|max:100',
                'phone' => 'required|numeric|max:100',
                'address' => 'required|string|max:150',
            ]);
        */
      /*  $customerId = Session::get('customerId');
      if($request->email){
            $existCustomer = Customer::where('email',$request->email)->orWhere('mobile',$request->phone)->first();    
        }else{
            $existCustomer = Customer::where('mobile',$request->phone)->first();
        }
        
        if($existCustomer){
            $customer = Customer::find($existCustomer->id);
            $customer->update( [
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,         
            ]);
        }else{
            $customer = Customer::create([
                'name'=>$request->name,
                'mobile'=>$request->phone,
                'email'=>$request->email,
                'address'=>$request->shipping_address,
            ]);
        } 

        $order = Order::create([
            'customer_id'=>$customer->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'shipping_address'=>$request->shipping_address,
            'shipping_location_id'=>$request->shipping_location_id,
            'shipping_location_name'=>$request->shipping_location_name,
            'shipping_charge'=>$request->shipping_charge,
            'payment_method'=>$request->payment_method,
            'total_amount'=>str_replace(',', '', $request->total_amount),
            'status'=>'Waiting',
        ]);
        
        $total = 0;

        foreach(Cart::content() as $cart){
            $product=Product::find($cart->id);
            $orderList = OrderList::create([
                'order_id'=>$order->id,
                'customer_id'=>$customer->id,
                'product_id'=>$product->id,
                'name'=>$product->name,
                'code'=>$product->deal_code,
                'qty'=>$cart->qty,
                'price'=>$cart->price,
                'total'=>$cart->qty*$cart->price,
                'status'=>'',
            ]);
        }
        Cart::destroy();
        $title = "Order Success";
        return view('frontend.shopping_cart.ordersuccess')->with(compact('title'));
    }*/
}
