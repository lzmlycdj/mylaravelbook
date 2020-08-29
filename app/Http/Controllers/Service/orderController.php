<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Models\M3Result;
use Illuminate\Http\Request;
class OrderController extends Controller
{
  
  public function toOrder(Request $request){
    return view('order_pay');
  }

}
