<?php

namespace App\Http\Controllers;

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
}
