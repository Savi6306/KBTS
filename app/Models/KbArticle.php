<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class KbArticle extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'is_published',
        'category_id',
        'views',
        'likes',
        'dislikes',
    ];

    /**
     * Scout searchable fields
     */
    public function toSearchableArray()
    {
        return [
             'id'      => $this->id,
            'title'   => $this->title,
            'content' => strip_tags($this->content), // content without HTML
        ];
    }

    /**
     * Category relationship
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
