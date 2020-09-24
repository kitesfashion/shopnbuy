<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Order;
use App\VerifyCustomer;
use App\CustomerGroup;
use App\Product;
use DB;
use Session;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "Customer";
        $customers = Customer::orderBy('id','dsc')->get();
        return view('admin.customers.index')->with(compact('title','customers'));
    }

    public function customerAdd()
    {
        $title = 'Customer';
        $customerGroup = CustomerGroup::orderBy('groupName','asc')->get();
        return view('admin.customers.add')->with(compact('title','customerGroup'));
    }

    public function customerSave(Request $request)
    {
        $dob = date('Y-m-d', strtotime($request->dob));
      
        $this->validate(request(), [
            'customer_name' => 'required', 
            'phone_number' => 'required',
            'email' => 'required', 
            'client_group' => 'required', 
        ]);

        // $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        $customer = Customer::create( [
            'name' => $request->customer_name,            
            'gender' => $request->gender,            
            'dob' => $dob,            
            'clientGroup' => $request->client_group,            
            'mobile' => $request->phone_number,            
            'email' => $request->email,
            'address' => $request->address,                   
        ]);

        return redirect(route('customers.index'))->with('msg','Customer Successfuly Saved');
    }

    public function customerEdit($id)
    {
        $title = "Customer";
        $customerGroup = CustomerGroup::orderBy('groupName','asc')->get();
        $customer = Customer::where('id',$id)->first();
        return view('admin.customers.edit')->with(compact('title','customerGroup','customer'));
    }

    public function customerUpdate(Request $request)
    {
        $dob = date('Y-m-d', strtotime($request->dob));
      
        $this->validate(request(), [
            'customer_name' => 'required', 
            'phone_number' => 'required',
            'email' => 'required', 
            'client_group' => 'required', 
        ]);

        // $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        $customerId = $request->customerId;
        $customer = Customer::find($customerId);

        $customer->update( [
            'name' => $request->customer_name,            
            'gender' => $request->gender,            
            'dob' => $dob,            
            'clientGroup' => $request->client_group,            
            'mobile' => $request->phone_number,            
            'email' => $request->email,
            'address' => $request->address,                   
        ]);

        return redirect(route('customers.index'))->with('msg','Customer Successfuly Updated'); 
    }

    public function customerDelete(Request $request)
    {   
        Customer::where('id',$request->customerId)->delete();
    }

    public function customerDetails($id)
    {   $title = "Customer Details";
        $customers = Customer::where('id',$id)->first();
        $customer_groups = CustomerGroup::where('groupStatus',1)->get();
        return view('admin.customers.customerDetails')->with(compact('title','customers','customer_groups'));
    }

    public function updateClientGroup(Request $request)
    {
        $customerId = $request->customerId;
        $customers = Customer::find($customerId);
        $clientGroup = implode(',', $request->clientGroup);
        $customers->update([
            'clientGroup' => $clientGroup,
        ]);
        return redirect(route('customers.index'))->with('msg','Customer Add to Group Successfully');    
    }

    // public function destroy(Customer $customer, Request $request)
    // {
    //     if($request->ajax())
    //     {
    //         $customer->delete();
    //         print_r(1);       
    //         return;
    //     }
    //     $customer->delete();
    //     return redirect(route('categories.index')) -> with( 'message', 'Deleted Successfully');
    // }

}
