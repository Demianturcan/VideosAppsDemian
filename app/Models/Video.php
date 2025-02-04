<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * @property mixed $published_at
 * @property mixed $title
 * @property mixed $url
 * @method static findOrFail(int $id)
 * @method static where(string $string, int $userId)
 * @method static create(array $array)
 * @method static find(string $id)
 */
class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'published_at',
        'url',
        'series_id'

    ];
    protected array $dates = ['published_at'];

    /**
     * Get the formatted published_at date.
     *
     * @return string
     */
    protected function getFormattedPublishedAtAttribute(): string
    {
        if ($this->published_at === null) {
            return '';
        }
        return Carbon::parse($this->published_at)->translatedFormat('j \o\f F \o\f Y');
    }

    /**
     * Get the human-readable published_at date.
     *
     * @return string
     */
    public function getFormattedForHumansPublishedAtAttribute(): string
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    /**
     * Get the Unix timestamp of the published_at date.
     *
     * @return int
     */
    public function getPublishedAtTimestampAttribute(): int
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
