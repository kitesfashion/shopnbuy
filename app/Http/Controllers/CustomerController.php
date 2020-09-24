<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Session;

use App\Customer;
use App\VerifyCustomer;
use App\Order;

class CustomerController extends Controller
{
    public function showLoginForm()
    {
        $setReview = @$_GET['setReview'];
        return view('frontend.customer.login')->with(compact('setReview'));
    }

    public function login(Request $request)
    {
        $setReview = $request->setReview;
        if ($request) {
            $email = $request->input('custemail');
          $password = $request->input('password');
          $hasPassword = md5($request->input('password'));

          @$getEmail= DB::table('customers')->where(['email'=>$email])->first();

          @$countEmail= DB::table('customers')->where(['email'=>$email])->count();

          @$countPassword = DB::table('customers')->where(['password'=>$hasPassword])->count();

          @$customerId = $getEmail->id;
          @$customername = $getEmail->name;

          if ($email == "" || $password == "") {
          $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Field must not be empty</h6>"; 
          Session::put('message',$message); 
          return redirect('/customer/login')->withInput();
          }elseif ($countEmail < 1) {
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Your Email Address Not Matched</h6>"; 
            Session::put('message',$message); 
            return redirect(route('customer.login', ['setReview'=>@$setReview]))->withInput();
          }elseif($countPassword < 1){
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Sorry, Password Not Matched</h6>"; 
              Session::put('message',$message); 
              return redirect(route('customer.login',['setReview'=>$setReview]))->withInput();
          }else{
            if ($countEmail > 0) {
              Session::put('customerId',$customerId);
              Session::put('customerName',$customername);

              if(@$setReview){
                $products = Product::where('id',$setReview)->first();
                $name = str_replace(' ', '-', $products->name);
                return redirect(url('product/'.@$products->id.'/'.@$name.'?setReview='.$setReview));
              }else{

              }
              return redirect(route('customer.order'));

            }
          }
        }
    }

    public function passwordForget()
    {
        return view('frontend.customer.passwordforget');
    }

    public function passwordMail(Request $request)
    {
        $email = $request->email;
        $countCustomer = Customer::where('email',$email)->count();
        $customerEmail = Customer::where('email',$email)->first();

        // @$password = $customerEmail->storePassword;

        // $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl"); 
        // $paramArray = array( 
        //   'userName' => "01832967276", 
        //   'userPassword' => "3e3198", 
        //   'messageText' => "Your Driver Vara Password:".$password, 
        //   'numberList' => $phone, 
        //   'smsType' => "TEXT", 
        //   'maskName' => 'DemoMask', 
        //   'campaignName' => '', );                         

        if ($countCustomer <1)
        {
            $message = "<h5 style='display:inline-block;width:auto;' class='alert alert-danger'>Email Addresss is Not Registered</h5>"; 

            return redirect(route('password.forget'))->with('msg',$message)->withInput();
        }
        else
        {   
            $customerEmail->update( [
                'verify_token' => $request->_token,
            ]);
            
            $message = "<h5 style='display:inline-block;width:auto;' class='alert alert-success'>Check your email inbox or spam</h5>"; 
            $subject = "Your Password Reset Link";
            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers = 'From: BIS <info@bis.com.bd>' . PHP_EOL;
            $headers .= 'Cc: info@bis.com.bd' . "\r\n";

            $link = "Your password reset link ".url('/customer/new-password/'.$email.'/'.$request->_token);

            mail($email, $subject, $link,$headers);
            return redirect(route('password.forget'))->with('msg',$message)->withInput();
        }
    }

    public function newPassword($email,$verify_token)
    {
        @$customer = Customer::where('email',$email)->where('verify_token',$verify_token)->first();
        if ($customer)
        {
            return view('frontend.customer.newpassword',['customer'=>$customer]);
        }
        else
        {
            return redirect('/customer/login');
        }
    }

    public function changePasswordSave(Request $request)
    {
        $this->validate($request,[
            'password' => 'required|same:confirmPassword',
            'confirmPassword' => 'required|min:6'
        ]);

        $allCustomer = Customer::where('email',$request->email)->first();
        $customerId = $allCustomer->id;
        $customer = Customer::find($customerId);
        $customer->password = md5($request->password);
        $customer->save();

        Session::put('customerId',$customerId);
        return redirect(route("customer.order"));
    }

    public function showRegistrationForm()
    {
        return view('frontend.customer.register');
    }

    public function customerRegister(Request $request)
    {
        $customers = new VerifyCustomer();
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $address = $request->input('address');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirmPassword');

        @$getcustomerEmail = Customer::where('email',$email)->count();
        @$getcustomerPhone = Customer::where('mobile',$mobile)->count();

        if ($getcustomerEmail > 0)
        {
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>This email address already registered</h6>";
            return redirect(route('customer.registration'))->with('msg',$message)->withInput();
        }
        elseif ($getcustomerPhone > 0)
        {
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>This phone number already registered</h6>";
            return redirect(route('customer.registration'))->with('msg',$message)->withInput();
        }
        elseif ($password != $confirmPassword)
        {
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Password and Confirm Password Not Matched</h6>"; 
            return redirect(route('customer.registration'))->with('msg',$message)->withInput();
        }
        else
        {   $verifyCode = rand(1000000,9999999);
        
            $customers->name = $name;
            $customers->email = $email;
            $customers->mobile = $mobile;
            $customers->address = $address;
            $customers->password = md5($request->password);
            $customers->confirmPassword = md5($request->confirmPassword);
            $customers->verifyCode = $verifyCode;
            $customers->save();
            
            $subject = "Email Confirmation";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers = 'From: BIS <info@bis.com.bd>' . PHP_EOL;
            $headers .= 'Cc: info@bis.com.bd' . "\r\n";
    
            $messageBody = $name." Confirm your email..Click given link ".url('/customer/confirm-link/').'/'.$verifyCode;

            mail($email, $subject, $messageBody ,$headers);
           
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-success'>Please check your email for confirmation</h6>"; 
            return redirect(route('customer.registration'))->with('msg',$message)->withInput();
        }   
    }

    public function verficationBox()
    {
        return view('frontend.customer.registerverify');
    }

    public function registerSave($verifyCode)
    {
        $getCustomer = VerifyCustomer::where('verifyCode',$verifyCode)->first();

        $countCustomer = VerifyCustomer::where('verifyCode',$verifyCode)->count();

        if ($countCustomer < 1)
        {
            $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Wrong Confirmation Code</h6>"; 
        }
        else
        {
            $custmomer = new Customer();

            $custmomer->name = $getCustomer->name;
            $custmomer->email = $getCustomer->email;
            $custmomer->mobile = $getCustomer->mobile;
            $custmomer->address = $getCustomer->address;
            $custmomer->gender = $getCustomer->gender;
            $custmomer->password = $getCustomer->password;
            $custmomer->confirmPassword = $getCustomer->confirmPassword;
            $custmomer->save();

            $customerId = $custmomer->id;

            Session::put('customerId',$customerId);
            Session::put('customerName',$getCustomer->name);

            $deleteverify = VerifyCustomer::where('verifyCode', $verifyCode);
            $deleteverify->delete();

            return redirect(route('home.index'));
        }
    }

    public function profile($id)
    {
        $customers = Customer::where('id',$id)->first();
        return view('frontend.customer.profile')->with(compact('customers'));
    }

    public function updateProfile(Request $request)
    {
        $customerId = $request->customerId;

        $customers = Customer::find($customerId);

        $customers->update( [           
            'name' => $request->name,              
            'email' => $request->email, 
            'mobile' => $request->mobile,            
            'address' => $request->address,                         
        ]);

        $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-success'>Profile Updated Successfully</h6>"; 

        return redirect(route('customer.profile',$customerId))->with('msg',$message);    
    }

    public function shippingEmail()
    {
        return view('frontend.order.shippingEmail');
    }

    public function viewOrder(Request $request)
    {
        if ($request)
        {
            $email = $request->input('custemail');
            $getEmail = Customer::where('email',$email)->orWhere('mobile',$email)->first(); 
            @$countEmail= count($getEmail);
            if ($email == "")
            {
                $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Field must not be empty</h6>"; 
                Session::put('message',$message); 
                return redirect('/shipping-email')->withInput();
            }
            elseif ($countEmail < 1)
            {
                $message = "<h6 style='display:inline-block;width:auto;' class='alert alert-danger'>Your Email or Phone No Not Matched</h6>"; 
                Session::put('message',$message); 
                return redirect('/shipping-email')->withInput();
            }
            else
            {
                if ($countEmail > 0)
                {
                    Session::put('customerId',$getEmail->id);
                    Session::put('password',$getEmail->password);
                    return redirect(route('customer.order'));
                }
            }
        }
    }

    public function orderList()
    {
        $customerId = Session::get('customerId');
        $orderlist = Order::where('customer_id',$customerId)->get();

        return view('frontend.order.orderlist')->with(compact('orderlist'));
    }

    public function orderDetails($id)
    {
        $orderlist = DB::table('order_list')
        ->get();
        return view('frontend.order.orderDetails')->with(compact('orderlist'));
    }

    public function logout()
    {
        $customerId = Session::get('customerId');
        $customerName = Session::get('customerName');
        Session::forget('customerId');
        Session::forget('customerName');
        return redirect(route('home.index'));
    }
}
