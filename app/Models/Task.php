<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model
{
    protected $fillable = [
        'uuid',
        'email',
        'title',
        'description',
        'status',
    ];

    protected function casts() {
        return [
            'status' => TaskStatus::class,
        ];
    }

    public function scopePendingOrIncompleted($query) {
        $query->where('status', TaskStatus::Pending)
            ->orWhere('status', TaskStatus::Incompleted);
    }
}
