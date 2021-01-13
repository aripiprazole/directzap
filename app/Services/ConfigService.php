<?php


namespace App\Services;


use App\Models\Code;
use App\Models\Config;
use App\Models\User;

class ConfigService {

  public function findCodeByCodeString($string): ?Code {
    /** @var Code $code */
    $code = Code::query()->where('Code', $string)->first();

    return $code;
  }

  public function findUserMaxTimesByEmail($email): ?int {
    /** @var Config $config */
    $config = Config::query()->where('email', $email)->first();
    if ($config == null) {
      return null;
    }

    return $config->vezes;
  }

  public function setUserCode(User $user, string $string): string {
    /** @var Code $code */
    if(filled($code = Code::query()->where('Email', $user->email))) {
      $code->code = $string;

      return $code->code;
    }

    $code = Code::query()->create([
      'code' => $string,
      'user' => $user
    ]);

    return $code->code;
  }

  public function setUserMaxTimes(User $user, int $times): int {
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
