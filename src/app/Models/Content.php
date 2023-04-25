<?php

namespace AnthonyEdmonds\SilverOwl\Models;

use AnthonyEdmonds\SilverOwl\Database\Factories\ContentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property array $breadcrumbs
 * @property string $slug
 * @property string $title
 * @property int $views
 */
class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'markdown',
        'title',
    ];

    protected $guarded = [
        'author_id',
        'category_id',
        'created_at',
        'id',
        'slug',
        'updated_at',
        'views',
    ];

    protected $casts = [
        'author_id' => 'int',
        'category_id' => 'int',
        'created_at' => 'datetime',
        'id' => 'int',
        'updated_at' => 'datetime',
        'views' => 'int',
    ];

    // Setup
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Setters
    public function setTitleAttribute(string $title): void
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    // Getters
    public function getBreadcrumbsAttribute(): array
    {
        $breadcrumbs = $this->category->breadcrumbs;
        $breadcrumbs[$this->title] = route('contents.show', [$this->category, $this]);

        return $breadcrumbs;
    }

    // Utilities
    public function addView(): self
    {
        $this->views++;
        $this->save();

        return $this;
    }

    protected static function newFactory(): ContentFactory
    {
        return new ContentFactory();
    }
}
