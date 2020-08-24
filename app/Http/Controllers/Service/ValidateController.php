<?php

namespace App\Http\Controllers\Service;

use App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// 引入发送短信类
use App\Tool\SMS\SendTemplateSMS;
use App\Entity\TempPhone;
use App\Models\M3Result;
use App\Entity\TempEmail;
use App\Entity\Member;

class ValidateController extends Controller
{
  public function create(Request $request)
  {
    $validateCode = new ValidateCode;
    // $request->session()->put('validate_code', $validateCode->getCode());
    return $validateCode->doimg();
  }
// 发送短信方法
  public function sendSMS(Request $request)
  {
    $m3_result = new M3Result;
  //  获取传进来的phone
    $phone = $request->input('phone', '');
  // 如果电话为空则返回
    if($phone == '') {
      $m3_result->status = 1;
      $m3_result->message = '手机号不能为空';
      // 将对象转化为json对象字符串返回
      return $m3_result->toJson();
    }
    if(strlen($phone) != 11 || $phone[0] != '1') {
      $m3_result->status = 2;
      $m3_result->message = '手机格式不正确';
      return $m3_result->toJson();
    }

    // 容量云发送短信begin
    $sendTemplateSMS = new SendTemplateSMS;
    $code = '';
    $charset = '1234567890';
    $_len = strlen($charset) - 1;
    for ($i = 0;$i < 6;++$i) {
        $code .= $charset[mt_rand(0, $_len)];
    }
    $m3_result = $sendTemplateSMS->sendTemplateSMS($phone, array($code, 60), 1);
 // 容量云发送短信end
// 开始将phone和验证码存入数据库里
    if($m3_result->status == 0) {
      $tempPhone = TempPhone::where('phone', $phone)->first();
      if($tempPhone == null) {
        $tempPhone = new TempPhone;
      }
      $tempPhone->phone = $phone;
      $tempPhone->code = $code;
      // 时间戳转成字符串保存到数据库
      $tempPhone->deadline = date('Y-m-d H-i-s', time() + 60*60);
      $tempPhone->save();
    }

    return $m3_result->toJson();
  }

  public function validateEmail(Request $request)
  {
    $member_id = $request->input('member_id', '');
    $code = $request->input('code', '');
    if($member_id == '' || $code == '') {
      return '验证异常';
    }

    $tempEmail = TempEmail::where('member_id', $member_id)->first();
    if($tempEmail == null) {
      return '验证异常';
    }

    if($tempEmail->code == $code) {
      if(time() > strtotime($tempEmail->deadline)) {
        return '该链接已失效';
      }

      $member = Member::find($member_id);
      $member->active = 1;
      $member->save();

      return redirect('/login');
    } else {
      return '该链接已失效';
    }
  }
}