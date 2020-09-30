<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class DataLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $startTime;

    public function handle($request, Closure $next)
    {
        $this->startTime = microtime(true);
        $data = $request->all();

        $response = $next($request);
        $name = \Route::currentRouteName();
        $guard = '';
        $user_id = 0;
        
        $endTime = microtime(true);
        \DB::table('data_log')->insert(
            [
                "time" => $endTime,
                "duration" => number_format($endTime - $this->startTime, 3),
                "ip" => $request->ip(),
                "url" => $request->fullUrl(),
                "method" => $request->method(),
                "input" => json_encode($data),
                "files" => print_r($data, true),
                "output" => json_encode($response->content()),
            ]);

        return $response;
    }

}
