<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;

class RoleCheckerMiddleware
{
    use HasRoles;
    public function handle(Request $request, Closure $next)
    {
        //  if (!Auth::user()->hasRole("Admin")) {
        //      return view('new_person');
        //  }
        
    }   
   }