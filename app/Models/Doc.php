<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Doc extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'slug',
        'is_public',
        'permission',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($doc) {
            if (empty($doc->slug)) {
                $doc->slug = Str::slug($doc->title);
            }
        });
    }

    /**
     * @return HasMany<Section, static>
     */
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    /**
     * @return HasMany<Page, static>
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    /**
     * @return BelongsTo<User, static>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
