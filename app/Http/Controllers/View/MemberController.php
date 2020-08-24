<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
  // 添加登陆页面方法
  public function toLogin($value='')
  {
    return view('login');
  }

  public function toRegister($value='')
  {
    return view('register');
  }
}
