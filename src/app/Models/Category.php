<?php

namespace AnthonyEdmonds\SilverOwl\Models;

use AnthonyEdmonds\SilverOwl\Database\Factories\CategoryFactory;
use AnthonyEdmonds\SilverOwl\Relationships\KeylessRelationship;
use AnthonyEdmonds\SilverOwl\Traits\HasKeylessRelationships;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @property string $index
 * @property string $name
 * @property Category|null $parent
 * @property int $parent_id
 * @property string $slug
 * @property Collection|null $subcategories
 * @property Collection|null $subcontents
 */
class Category extends Model
{
    use HasFactory;
    use HasKeylessRelationships;

    protected $fillable = [
        'description',
        'name',
    ];

    protected $guarded = [
        'created_at',
        'id',
        'index',
        'parent_id',
        'slug',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'id' => 'int',
        'parent_id' => 'int',
        'updated_at' => 'datetime',
    ];

    // Setup
    protected static function booted(): void
    {
        parent::booted();

        static::addGlobalScope('orderByName', function (Builder $query) {
            $query->orderBy('name');
        });

        static::created(function (Category $category) {
            $category->setIndex();
            $category->saveQuietly();
        });

        static::updating(function (Category $category) {
            if ($category->isDirty('parent_id') === true) {
                $category->updateIndex();
            }
        });
    }

    // Relationships
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function subcategories(): KeylessRelationship
    {
        return $this->keylessRelation(Category::class, [
            [
                'remote_column' => 'index',
                'comparator' => 'LIKE',
                'value' => "$this->index-%",
            ],
        ]);
    }

    public function subcontents(): Builder
    {
        return $this->keylessRelation(Content::class, [
            [
                'remote_column' => 'categories.index',
                'comparator' => 'LIKE',
                'value' => "$this->index%",
            ],
        ])
            ->leftJoin('categories', 'categories.id', '=', 'contents.category_id');
    }

    // Setters
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    // Utilities
    public function setIndex(): void
    {
        $this->index = $this->parent === null
            ? $this->id
            : "{$this->parent->index}-{$this->id}";
    }

    public function updateIndex(): void
    {
        $oldIndex = $this->index;
        $this->setIndex();
        $newIndex = $this->index;

        $this->newQuery()
            ->where('index', 'LIKE', "$oldIndex-%")
            ->update([
                'index' => DB::raw("REPLACE(`index`, '$oldIndex', '$newIndex')"),
            ]);
    }

    protected static function newFactory(): CategoryFactory
    {
        return new CategoryFactory();
    }
}
