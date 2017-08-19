<?php
namespace App\Http\Middleware;
use Closure;
class BasicAuthJsonMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if($request->getUser() != 'admin' || $request->getPassword() != '123456') {
            $data = array(
                'success' => false,
                'error_code' => 401, 
                'error_msg' => 'Not authorized',
            );
            response('Not authorized', 401);
            return response()->json($data, 401);
        }
        return $next($request);
    }
}