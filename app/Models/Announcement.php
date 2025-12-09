<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category',
        'images',
        'is_pinned',
        'is_active',
        'published_at',
        'created_by',
    ];

    protected $casts = [
        'images' => 'array',
        'is_pinned' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
