<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;

class Controller extends BaseController
{	
	public $deliveryZoneId;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct() {
    	$this->middleware(function ($request, $next) {
            $this->deliveryZoneId = @Auth::user()->delivery_zone_id;
            return $next($request);
         });
      
   }

}
