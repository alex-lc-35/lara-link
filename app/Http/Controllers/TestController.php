<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;

class TestController
{
    public function test() {
        $shortLinks = ShortLink::all();
        dd($shortLinks);
    }
}
