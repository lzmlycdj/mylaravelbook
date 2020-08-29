<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
  // 添加登陆页面方法
  public function toLogin(Request $request)
  {
    // 如果没有登陆就重定向url，返回给login试图
    $return_url = $request->input('return_url', '');
    return view('login')->with('return_url', urldecode($return_url));
    
  }

  public function toRegister($value = '')
  {
    return view('register');
  }
}
