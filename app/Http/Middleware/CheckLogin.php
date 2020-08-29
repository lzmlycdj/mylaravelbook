<?php

namespace App\Http\Middleware;

use Closure;
/**
 * 
 * 验证登陆中间件,发现没有登陆就直接跳转登陆页面，否则直接返回
 */
class CheckLogin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $member = $request->session()->get('member', '');
      
        if($member == '') {
          $return_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          return redirect('/login?return_url=' . urlencode($return_url));
        }
        // 验证通过，执行下一步
        return $next($request);
    }

}
