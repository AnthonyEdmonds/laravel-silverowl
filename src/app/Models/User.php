<?php

namespace AnthonyEdmonds\SilverOwl\Models;

use AnthonyEdmonds\SilverOwl\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
    ];

    protected $guarded = [
        'created_at',
        'id',
        'password',
        'remember_token',
        'slug',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'id' => 'int',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function contents(): HasMany
    {
        return $this->hasMany(Content::class, 'author_id', 'id');
    }

    // Setters
    public function setUsernameAttribute(string $username): void
    {
        $this->attributes['username'] = $username;
        $this->attributes['slug'] = Str::slug($username);
    }

    // Utilities
    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
