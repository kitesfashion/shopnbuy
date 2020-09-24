<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Review;
use Session;

class ReviewController extends Controller
{
    public function index()
    {
        $title = "Manage Reviews";
        $reviews = Review::all();
        return view('admin.reviews.index')->with(compact('title','reviews'));
    }

    public function customerReview(Request $request){
    	 $this->validate(request(), [
            'name' => 'required',
            'summary' => 'required',
            'review' => 'required',
            'star' => 'required',
             
        ]);

    	 $productId = $request->productId;
    	 $productName = $request->productName;
    	 $customerId = Session::get('customerId');

        $review = Review::create( [     
            'customerId' =>$customerId,           
            'productId' =>$request->productId,           
            'name' => $request->name,           
            'summary' => $request->summary,                     
            'review' => $request->review, 
            'star' => $request->star,            
            'status' => '1',            
              
        ]);

        // $product = Product::create($request->all());

        return redirect(url('product/'.@$productId.'/'.@$productName))->with('msg','Review Complete Successfully');
    }

    public function reviewDetails($id)
    {
        $title = "Review Details";
        $reviews = Review::where('id',$id)->first();
        return view('admin.reviews.reviewDetails')->with(compact('title','reviews'));
    }

     public function changereviewStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = Review::find($request->review_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('reviews.index')) -> with( 'message', 'Wrong move!');
    }

     public function destroy(Review $review, Request $request)
    {
        if($request->ajax())
        {
            $review->delete();
            print_r(1);       
            return;
        }

        $policy->delete();
        return redirect(route('reviews.index')) -> with( 'message', 'Deleted Successfully');
    }

  
    
}
