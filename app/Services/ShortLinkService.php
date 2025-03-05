<?php

namespace App\Services;

use App\Models\ShortLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ShortLinkService
{
    private array $rules = [
        'name' => 'required|string|min:5|max:50',
        'url' => 'required|url',
    ];

    public function create(array $data): ShortLink
    {
        $this->checkRules($data);

        $data['user_id'] = Auth::id();
        $data['link'] = $this->generateSlug($data['name']);

        return ShortLink::create($data);
    }

    public function update(int $id, array $data): ShortLink
    {
        $shortLink = ShortLink::where('user_id', Auth::id())->findOrFail($id);

        $this->checkRules($data);

        if (isset($data['name']) && $data['name'] !== $shortLink->name) {
            $data['link'] = $this->generateSlug($data['name']);
        }

        $shortLink->update($data);
        return $shortLink;
    }

    public function delete(int $id): bool
    {
        $shortLink = ShortLink::where('user_id', Auth::id())->findOrFail($id);
        return $shortLink->delete();
    }

    /**
     * @param int $id
     * @return int
     * Incrémente la variable clicks et retourne sa nouvelle valeur
     */
    public function copyIncrement(int $id): int
    {
        $shortLink = ShortLink::findOrFail($id);
        $shortLink->increment('clicks');
        return $shortLink->fresh()->clicks;
    }

    private function checkRules(array $data): void
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    private function generateSlug(string $name): string {
        $cleanName = Str::of($name)
            ->replaceMatches('/[^A-Za-z0-9\s]/', '')
            ->trim();

        $slug = Str::slug($cleanName);

        if (ShortLink::where('link', $slug)->exists()) {
            throw ValidationException::withMessages([
                'name' => ["Un lien avec ce nom existe déjà."]
            ]);
        }

        return $slug;
    }
}
