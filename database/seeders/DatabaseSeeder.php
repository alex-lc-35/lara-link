<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $firstUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $secondUser = User::factory()->create([
            'name' => 'Alexandre LE CAM',
            'email' => 'alexandre.lecam@example.com',
        ]);

        $links = [
            ['name' => 'Google', 'url' => 'https://www.google.com', 'link' => 'google'],
            ['name' => 'GitHub', 'url' => 'https://github.com', 'link' => 'github'],
            ['name' => 'Laravel', 'url' => 'https://laravel.com', 'link' => 'laravel'],
            ['name' => 'Stack Overflow', 'url' => 'https://stackoverflow.com', 'link' => 'stack-overflow'],
            ['name' => 'Wikipedia', 'url' => 'https://www.wikipedia.org', 'link' => 'wikipedia'],
            ['name' => 'Twitter', 'url' => 'https://twitter.com', 'link' => 'twitter'],
            ['name' => 'Facebook', 'url' => 'https://facebook.com', 'link' => 'facebook'],
            ['name' => 'YouTube', 'url' => 'https://youtube.com', 'link' => 'youtube'],
        ];

        foreach ($links as $data) {
            ShortLink::factory()->create([
                "user_id" => $firstUser->id,
                'name' => $data['name'],
                'link' => $data['link'],
                'url' => $data['url'],
            ]);
        }

        $links = [
            ['name' => 'Recherche Google', 'url' => 'https://www.google.com', 'link' => 'recherche-google'],
            ['name' => 'Dépôts GitHub', 'url' => 'https://github.com', 'link' => 'depots-github'],
            ['name' => 'Framework Laravel', 'url' => 'https://laravel.com', 'link' => 'framework-laravel'],
            ['name' => 'Articles Wikipédia', 'url' => 'https://www.wikipedia.org', 'link' => 'articles-wikipedia'],
            ['name' => 'Fil Twitter', 'url' => 'https://twitter.com', 'link' => 'fil-twitter'],
            ['name' => 'Pages Facebook', 'url' => 'https://facebook.com', 'link' => 'pages-facebook'],
            ['name' => 'Vidéos YouTube', 'url' => 'https://youtube.com', 'link' => 'videos-youtube'],
            ['name' => 'Discussions Reddit', 'url' => 'https://www.reddit.com', 'link' => 'discussions-reddit'],
            ['name' => 'Réseau LinkedIn', 'url' => 'https://www.linkedin.com', 'link' => 'reseau-linkedin'],
            ['name' => 'Shopping Amazon', 'url' => 'https://www.amazon.com', 'link' => 'shopping-amazon'],
            ['name' => 'Documentation Microsoft', 'url' => 'https://docs.microsoft.com', 'link' => 'documentation-microsoft'],
            ['name' => 'Assistance Apple', 'url' => 'https://support.apple.com', 'link' => 'assistance-apple'],
            ['name' => 'Films Netflix', 'url' => 'https://www.netflix.com', 'link' => 'films-netflix'],
            ['name' => 'Musique Spotify', 'url' => 'https://www.spotify.com', 'link' => 'musique-spotify'],
            ['name' => 'Adobe Creative Cloud', 'url' => 'https://www.adobe.com/creativecloud.html', 'link' => 'adobe-creative-cloud'],
            ['name' => 'Navigateur Firefox', 'url' => 'https://www.mozilla.org/fr/firefox/', 'link' => 'navigateur-firefox'],
            ['name' => 'Voitures Tesla', 'url' => 'https://www.tesla.com', 'link' => 'voitures-tesla'],
            ['name' => 'ChatGPT OpenAI', 'url' => 'https://chat.openai.com', 'link' => 'chatgpt-openai'],
            ['name' => 'Programmation Python', 'url' => 'https://www.python.org', 'link' => 'programmation-python'],
        ];

        foreach ($links as $data) {
            ShortLink::factory()->create([
                "user_id" => $secondUser->id,
                'name' => $data['name'],
                'link' => $data['link'],
                'url' => $data['url'],
            ]);
        }

    }
}
