<?php

namespace AnthonyEdmonds\SilverOwl\Models;

use AnthonyEdmonds\SilverOwl\Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * @property string $label
 * @property string $slug
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'colour',
        'label',
    ];

    protected $guarded = [
        'created_at',
        'id',
        'slug',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'id' => 'int',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class);
    }

    // Setters
    public function setLabelAttribute(string $label): void
    {
        $this->attributes['label'] = $label;
        $this->attributes['slug'] = Str::slug($label);
    }

    // Utilities
    protected static function newFactory(): TagFactory
    {
        return new TagFactory();
    }
}
