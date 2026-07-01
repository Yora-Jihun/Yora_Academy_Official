<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    protected $fillable = [
        'doc_id',
        'title',
        'order',
    ];

    /**
     * @return BelongsTo<Doc, static>
     */
    public function doc(): BelongsTo
    {
        return $this->belongsTo(Doc::class);
    }

    /**
     * @return HasMany<Page, static>
     */
    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }
}
