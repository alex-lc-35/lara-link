<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TestController
{
    protected ShortLinkService $shortLinkService;
    public function __construct(ShortLinkService $shortLinkService)
    {
        $this->shortLinkService = $shortLinkService;
    }


    public function test() {
        $this->shortLinkService->copyIncrement(35);

        $res = ShortLink::find(35);

        dd($res);
    }

    public function testServiceCreate() {
        $user = Auth::loginUsingId(1);

        $shortLink = $this->shortLinkService->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        dd($shortLink);
    }

    public function testUserShortLinks() {
        $user = Auth::loginUsingId(1);
        ShortLink::factory(10)->create(['user_id' => $user->id]);
        dd($user->shortLinks);
    }
}
