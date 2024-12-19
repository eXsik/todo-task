<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskAccessToken;
use Illuminate\Support\Facades\Auth;

class TaskAccessTokenService
{
  public function generateToken(Task $task): TaskAccessToken
  {
    $existingToken = $task->accessTokens()->where('expires_at', '>', now())->first();

    if ($existingToken) {
      throw new \Exception('Token dostępu już istnieje lub jest nadal ważny.');
    }

    $token = bin2hex(random_bytes(32));
    $expiresAt = now()->addHours(24);

    return $task->accessTokens()->create([
      'token' => $token,
      'expires_at' => $expiresAt
    ]);
  }

  public function isInvalidToken(Task $task, string $token): bool
  {
    $accessToken = $task->accessTokens()
      ->where('token', $token)
      ->where('expires_at', '>', now())
      ->first();

    return $accessToken !== null;
  }
}
