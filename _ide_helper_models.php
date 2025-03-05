<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $link
 * @property string $url
 * @property int $clicks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $short_link
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ShortLinkFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereClicks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ShortLink whereUserId($value)
 */
	class ShortLink extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ShortLink> $shortLinks
 * @property-read int|null $short_links_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

