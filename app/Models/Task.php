<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    const STATUS_PENDING = 'Pending';
    const STATUS_IN_PROGRESS = 'In-Progress';
    const STATUS_COMPLETED = 'Completed';
    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'description',
        'due_date',
        'status'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
