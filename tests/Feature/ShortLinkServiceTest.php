<?php


use App\Models\ShortLink;
use App\Models\User;
use App\Services\ShortLinkService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class ShortLinkServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(ShortLinkService::class);
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_create(): void
    {
        $shortLink = $this->service->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        $this->assertEquals('mon-lien', $shortLink->link);
    }

    public function test_update(): void
    {
        $shortLink = $this->service->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        $shortLink = $this->service->update($shortLink->id, [
            'name' => 'Nouveau lien',
            'url' => 'https://example.com/',
        ]);

        $this->assertEquals('nouveau-lien', $shortLink->link);
    }

    public function test_delete(): void
    {
        $shortLink = $this->service->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        $this->service->delete($shortLink->id);

        $this->assertNull(ShortLink::find($shortLink->id));
    }

    public function test_link_format(): void
    {
        $shortLink = $this->service->create([
            'name' => '?Mon/ lien.   8*+',
            'url' => 'https://example.com/',
        ]);

        $this->assertEquals('mon-lien-8', $shortLink->link);
    }

    public function test_rules(): void
    {
        $this->expectException(ValidationException::class);

        $this->setUpFaker();

        $invalidCases = [
            ['name' => '', 'url' => 'https://example.com/'], // name vide
            ['name' => Str::limit($this->faker->text(10), 3, ''), 'url' => 'https://example.com/'], // name < 5 caractères
            ['name' => Str::limit($this->faker->text(55), 55, ''), 'url' => 'https://example.com/'], // name > 50 caractères
            ['name' => 'ValidName', 'url' => $this->faker->word], // URL invalide
            ['name' => 'ValidName'], // URL manquante
        ];

        foreach ($invalidCases as $case) {
            $this->service->create($case);
        }
    }

    public function test_unique_link(): void
    {
        $shortLinkFirst = $this->service->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        $this->expectException(ValidationException::class);

        try {
            $shortLinkSecond = $this->service->create([
                'name' => 'Mon lien',
                'url' => 'https://google.com/',
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertContains(
                'Un lien avec ce nom existe déjà.',
                $errors['name']
            );

            throw $e;
        }
    }

    public function test_errors_message(): void
    {
        $this->expectException(ValidationException::class);

        try {
            $this->service->create([
                'name' => 'Mon',
                'url' => 'example.com/',
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();

            $this->assertArrayHasKey('name', $errors);

            $this->assertContains(
                'Le texte du champ nom doit contenir au moins 5 caractères.',
                $errors['name']
            );

            $this->assertContains(
                'Le url doit être une URL valide.',
                $errors['url']
            );

            throw $e;
        }
    }

    public function test_clicks_increment(): void
    {
        $shortLink = $this->service->create([
            'name' => 'Mon lien',
            'url' => 'https://example.com/',
        ]);

        $this->assertEquals(0, $shortLink->clicks);

        $clicks = $this->service->copyIncrement($shortLink->id);
        $this->assertEquals(1, $clicks);

        $clicks = $this->service->copyIncrement($shortLink->id);
        $this->assertEquals(2, $clicks);
    }
}
