<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'purpose',
        'required_info',
        'status',
        'fee',
        'payment_status',
        'tracking_number',
        'remarks',
        'claimed_at',
    ];

    protected $casts = [
        'required_info' => 'array',
        'payment_status' => 'boolean',
        'claimed_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->tracking_number)) {
                $model->tracking_number = 'TRK-' . strtoupper(Str::random(10));
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
