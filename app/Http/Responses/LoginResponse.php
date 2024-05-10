<?php

namespace App\Http\Responses;
use Illuminate\Support\Facades\Cookie;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        // $home = auth()->user()->is_admin ? '/admin' : '/dashboard';
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        } else {
            $intendedUrl = Cookie::get('my_intented_url');
            if(!empty($intendedUrl)){
                Cookie::forget('my_intented_url');
                return redirect()->intended($intendedUrl);
            } else {
                return redirect()->intended(config('fortify.home'));
            }
        }
    }
}
