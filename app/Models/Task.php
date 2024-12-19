<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;
    use HasUuids;

    public $incrementing = false;
    public static $priorityLabels = [
        'low' => 'low',
        'medium' => 'medium',
        'high' => 'high'
    ];
    public static $statusLabels = [
        'to-do' => 'to do',
        'in-progress' => 'in progress',
        'done' => 'finished'
    ];
    protected $keyType = 'string';
    protected $fillable = ['name', 'description', 'priority', 'status', 'expiration_date', 'user_id'];

    protected $casts = ['expiration_date' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(TaskHistory::class);
    }

    public function accessTokens(): HasMany
    {
        return $this->hasMany(TaskAccessToken::class);
    }

    public function scopePriority(Builder $query, $priority): Builder
    {
        if ($priority) {
            return $query->where('priority', $priority);
        }

        return $query;
    }

    public function scopeStatus(Builder $query, $status): Builder
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }

    public function scopeExpirationDate(Builder $query, $expirationDate): Builder
    {
        if ($expirationDate) {
            return $query->whereDate('expiration_date', $expirationDate);
        }

        return $query;
    }

    public function getPriorityAttribute($value): mixed
    {
        return self::$priorityLabels[$value] ?? $value;
    }

    public function getStatusAttribute($value): mixed
    {
        return self::$statusLabels[$value] ?? $value;
    }
}
