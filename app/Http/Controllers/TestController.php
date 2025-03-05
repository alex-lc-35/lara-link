<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Support\Facades\Auth;

class TestController
{
    public function test() {
        $user = Auth::loginUsingId(1);
        dd($user->shortLinks);
    }
}
