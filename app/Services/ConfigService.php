<?php


namespace App\Services;


use App\Models\Code;
use App\Models\Collaborator;
use App\Models\Config;
use App\Models\User;

class ConfigService {
  public const DEFAULT_MAX_COLLABORATORS = 8;

  public function hasOverloadedCollaborators($email): bool {
    $maxCollaborators = $this->findMaxCollaboratorsByEmail($email);
    $collaborator = Collaborator::query()
      ->where('email', $email)
      ->get();

    return $collaborator->count() >= $maxCollaborators;
  }

  public function findCodeByCodeString($string): ?Code {
    /** @var Code $code */
    $code = Code::query()->where('Codigo', $string)->first();

    return $code;
  }

  public function findUserTimesByEmail($email): ?int {
    /** @var Config $config */
    $config = Config::query()->where('email', $email)->first();
    if ($config == null) {
      return null;
    }

    return $config->vezes;
  }

  public function findMaxCollaboratorsByEmail($email): int {
    /** @var Config $config */
    $config = Config::query()->where('email', $email)->first();
    if ($config == null) {
      return self::DEFAULT_MAX_COLLABORATORS;
    }

    return $config->maxCollaborators ?: self::DEFAULT_MAX_COLLABORATORS;
  }

  public function setUserCode(User $user, string $string): string {
    /** @var Code $code */
    if (filled($code = Code::query()->where('Email', $user->email)->first())) {
      $code->code = $string;
      $code->save();

      return $code->code;
    }

    $code = Code::query()->create([
      'code' => $string,
      'user' => $user
    ]);

    return $code->code;
  }

  public function setUserTimes(User $user, int $times): int {
    /** @var Config $config */
    if (filled($config = Config::query()->where('email', $user->email)->first())) {
      $config->vezes = $times;
      $config->save();

      return $config->vezes;
    }

    $config = Config::query()->create([
      'vezes' => $times,
      'user' => $user
    ]);

    return $config->vezes;
  }
}
