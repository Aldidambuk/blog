<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'author', 'body'];

    protected $with = ['author','category'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }


    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
        // fungsi keyword untuk menulis pencarian 
            return $query->where('title', 'like', '%' . $search . '%');
    });

     $query->when($filters['category'] ?? false, function ($query, $category) {
        // fungsi keyword untuk menulis pencarian 
            return $query->whereHas(
                'category', 
                fn(Builder $query) =>
                $query->where('slug', $category)
            );
        });

        $query->when($filters['author'] ?? false, function ($query, $author) {
        // fungsi keyword untuk menulis pencarian 
            return $query->whereHas(
                'author', 
                fn(Builder $query) =>
                $query->where('username', $author)
            );
        });
    }
}
