<?php
// 短信api model，会产生各种信息方法够给请求者
namespace App\Models;

class M3Result {

  public $status;
  public $message;

  public function toJson()
  {
    return json_encode($this, JSON_UNESCAPED_UNICODE);
  }

}
