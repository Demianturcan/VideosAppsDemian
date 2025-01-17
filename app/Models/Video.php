<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * @property mixed $published_at
 * @method static findOrFail(int $id)
 * @method static where(string $string, int $userId)
 * @method static create(array $array)
 * @method static find(string $id)
 */
class Video extends Model
{
    protected array $dates = ['published_at'];

    /**
     * Get the formatted published_at date.
     *
     * @return string
     */
    public function getFormattedPublishedAtAttribute(): string
    {
        return Carbon::parse($this->published_at)->translatedFormat('j \d\e F \d\e Y');
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
