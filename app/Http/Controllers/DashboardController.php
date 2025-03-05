<?php

namespace App\Http\Controllers;

use App\Services\ShortLinkService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    protected ShortLinkService $shortLinkService;

    public function __construct(ShortLinkService $shortLinkService)
    {
        $this->shortLinkService = $shortLinkService;
    }

    /**
     * Afficher la liste des liens avec pagination
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $shortLinks = auth()->user()->shortLinks()->orderBy('updated_at', 'desc')->paginate($perPage);

        return view('dashboard', compact('shortLinks'));
    }

    public function deleteLink(int $id)
    {
        $this->shortLinkService->delete($id);
        return redirect()->route('dashboard')->with('success', 'Lien supprimé avec succès.');
    }

    public function createLink(Request $request)
    {
        try {
            $this->shortLinkService->create($request->only(['name', 'url']));
            return redirect()->route('dashboard')->with('success', 'Lien créé avec succès.');
        } catch (ValidationException $e) {
            return redirect()->route('dashboard')->withErrors($e->errors())->withInput();
        }
    }

    public function updateLink(Request $request, $id)
    {
        try {
            $this->shortLinkService->update($id, $request->only(['name', 'url']));
            return redirect()->route('dashboard')->with('success', 'Lien mis à jour avec succès.');
        } catch (ValidationException $e) {
            return redirect()->route('dashboard')->withErrors($e->errors())->withInput();
        }
    }
}
