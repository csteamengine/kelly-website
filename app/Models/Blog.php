<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Blog extends Model implements HasMedia
{
    use HasFactory,
        InteractsWithMedia,
        SoftDeletes;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'author_id',
        'short_description',
        'tags',
        'description',
        'page_content',
        'external_url',
        'is_active',
        'order',
        'started_at',
        'finished_at',
    ];

    /**
     * @param Media|null $media
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        if ($media->getTypeFromMime() == 'pdf') {
            $this->addMediaConversion('thumb');
        } else {
            $this->addMediaConversion('thumb')
                ->width(368)
                ->height(232)
                ->sharpen(10);
        }
    }
}
