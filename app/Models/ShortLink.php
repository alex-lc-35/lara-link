<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Config;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $link
 * @property string $url
 * @property int $clicks
 * @property-read string $short_link
 * @property-read User $user
 */
class ShortLink extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'link', 'url', 'clicks'];

    protected $appends = ['shortLink'];

    public function getShortLinkAttribute(): string
    {
        return Config::get('app.url') . '/sl/' . $this->link;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
