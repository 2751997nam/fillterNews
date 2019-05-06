<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'author', 'thumbnail', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getThumbnailAttribute($value)
    {
        return config('app.url') . Storage::url($value);
    }
}
