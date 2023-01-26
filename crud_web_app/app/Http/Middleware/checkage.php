<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Carbon\carbon;

class checkage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $dob = Auth::user()->dob;
        $age = Carbon::parse($dob)->age;
        // dd($age);
        
        if($age<18){
            // return redirect('noaccess');
            return redirect()->route('dashboard')->with('error','you have no access ...');
        } 
        else{
            return $next($request);    
        }
        
    } 
}
