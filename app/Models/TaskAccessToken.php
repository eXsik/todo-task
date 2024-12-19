<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskAccessToken extends Model
{
    protected $fillable = ['task_id', 'token', 'expires_at'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    // public static function generateToken(Task $task): TaskAccessToken
    // {
    //     $token = bin2hex(random_bytes(32));
    //     $expiresAt = now()->addHours(24);

    //     return self::create([
    //         'task_id' => $task->id,
    //         'token' => $token,
    //         'expires_at' => $expiresAt
    //     ]);
    // }

    // public function isExpired(): bool
    // {
    //     return now()->greaterThan($this->expires_at);
    // }
}
