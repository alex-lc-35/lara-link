<?php


use App\Models\ShortLink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_create(): void
    {
        $user = User::factory()->create();

        ShortLink::create([
            'user_id' => $user->id,
            'name' => 'Mon lien',
            'link' => 'mon-lien',
            'url' => 'https://example.com/',
        ]);

        $this->assertDatabaseHas('short_links', ['name' => 'Mon lien']);
    }

    public function test_update(): void
    {
        $user = User::factory()->create();

        $shortLink = ShortLink::create([
            'user_id' => $user->id,
            'name' => 'Mon lien',
            'link' => 'mon-lien',
            'url' => 'https://example.com/',
        ]);

        ShortLink::find($shortLink->id)->update([
            'name' => 'Nouveau lien',
            'link' => 'nouveau-lien',
        ]);

        $this->assertDatabaseHas('short_links', ['name' => 'Nouveau lien']);
    }

    public function test_delete(): void
    {
        $user = User::factory()->create();

        $shortLink = ShortLink::create([
            'user_id' => $user->id,
            'name' => 'Mon lien',
            'link' => 'mon-lien',
            'url' => 'https://example.com/',
        ]);

        ShortLink::find($shortLink->id)->delete();

        $this->assertNull(ShortLink::find($shortLink->id));
    }

    public function test_ShortLinkAttribute(): void
    {
        $user = User::factory()->create();

        $shortLink = ShortLink::create([
            'user_id' => $user->id,
            'name' => 'Mon lien',
            'link' => 'mon-lien',
            'url' => 'https://example.com/',
        ]);

        $this->assertEquals(config('app.url') . "/sl/mon-lien", $shortLink->shortLink);

        ShortLink::find($shortLink->id)->update([
            'name' => 'Nouveau lien',
            'link' => 'nouveau-lien',
        ]);

        $updatedShortLink = ShortLink::find($shortLink->id);

        $this->assertEquals("http://localhost:8000/sl/nouveau-lien", $updatedShortLink->shortLink);
    }
}
