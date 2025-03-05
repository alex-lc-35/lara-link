<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Illuminate\Http\Request;

class ShortLinkController extends Controller
{
    protected ShortLinkService $shortLinkService;

    public function __construct(ShortLinkService $shortLinkService)
    {
        $this->shortLinkService = $shortLinkService;
    }

    public function copyIncrement($id)
    {
        return $this->shortLinkService->copyIncrement($id);
    }

    public function redirect($slug)
    {
        $shortLink = ShortLink::where('link', $slug)->first();

        if ($shortLink) {
            return redirect($shortLink->url);
        }

        return redirect()->route('short-link.not-found');
    }

    public function notFound()
    {
        return view('pages.link-not-found');
    }
}
