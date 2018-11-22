<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use Session;

class ProductController extends Controller
{
    public function addProducts(Request $request) {
	    Session::push('products', [
        	'product_id' => $request->id,
        	'product_name' => $request->nm,
          	'product_qty' => $request->pr
	    ]);

	    return redirect()->route('home');
    }
}
