<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PharmDeptHodAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('admin')->check() && Auth::guard('admin')->user()->dept_id == '2' && Auth::guard('admin')->user()->dept_office_id == '1'){
         
            return $next($request);
        }
        return redirect('/');

       
    }
}
