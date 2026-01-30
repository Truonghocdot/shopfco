<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // Published status
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'thumbnail',
        'published',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'integer',
            'view_count' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Helper methods
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isPublished(): bool
    {
        return $this->published === self::STATUS_PUBLISHED;
    }

    public function isDraft(): bool
    {
        return $this->published === self::STATUS_DRAFT;
    }

    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }

    public function publish(): void
    {
        $this->update(['published' => self::STATUS_PUBLISHED]);
    }

    public function unpublish(): void
    {
        $this->update(['published' => self::STATUS_DRAFT]);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published', self::STATUS_PUBLISHED);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
