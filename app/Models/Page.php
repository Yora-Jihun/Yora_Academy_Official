<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'doc_id',
        'section_id',
        'title',
        'slug',
        'content',
        'permission',
        'is_public',
        'order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * @return BelongsTo<Doc, static>
     */
    public function doc(): BelongsTo
    {
        return $this->belongsTo(Doc::class);
    }

    /**
     * @return BelongsTo<Section, static>
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
