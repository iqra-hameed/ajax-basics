<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
//     public function handle(Request $request, Closure $next,$roles)
//     {

//         if (!Auth::check())
//         return redirect('login');

//     $user = Auth::user();

//     if($user->isCustomer())
//         return $next($request);

//     foreach($roles as $role) {

//         if($user->hasRole($role))
//             return $next($request);
//     }

//     return redirect('login');
// }
public function handle(Request $request, Closure $next)
{
    $user = DB::table('users')->select('role')->where('id',1)->first();

    if ($user && (int)$user->role === 1){

        return redirect("/");
    }

    return $next($request);
}

    }

