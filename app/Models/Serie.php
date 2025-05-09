<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'user_name',
        'user_photo_url',
        'published_at'
    ];

    protected $dates = ['published_at'];


    public function testedby(): BelongsTo
    {
        return $this->belongsTo(User::class, 'tested_by');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'series_id');
    }

    /**
     * Get the formatted created_at date.
     *
     * @return string
     */
    public function getFormattedCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->translatedFormat('j \o\f F \o\f Y');
    }

    /**
     * Get the human-readable created_at date.
     *
     * @return string
     */
    public function getFormattedForHumansCreatedAtAttribute(): string
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    /**
     * Get the Unix timestamp of the created_at date.
     *
     * @return int
     */
    public function getCreatedAtTimestampAttribute(): int
    {
        return Carbon::parse($this->created_at)->timestamp;
    }
}
