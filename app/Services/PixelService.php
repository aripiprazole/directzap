<?php


namespace App\Services;


use App\Models\Pixel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PixelService {
  public function createPixel(User $user, $string): Pixel {
    /** @var Pixel $pixel */
    if (filled($pixel = Pixel::query()->where('Email', $user->email)->first())) {
      $pixel->update([
        'code' => $string
      ]);

      return $pixel;
    }

    $pixel = Pixel::query()->create([
      'code' => $pixel,
      'user' => $string
    ]);

    return $pixel;
  }

  public function findPixelByFullName($fullName): ?Pixel {
    /** @var User $user */
    $user = User::query()
      ->where(DB::raw('CONCAT(nome, Sobrenome)'), 'LIKE', $fullName)
      ->first() ?: User::query()
      ->where(DB::raw('CONCAT(nome, \' \',  Sobrenome)'), 'LIKE', $fullName)
      ->first();

    if ($user == null) {
      return null;
    }

    $pixel = Pixel::query()->where('Email', $user->email)->firstOrFail();
    if ($pixel == null) {
      return null;
    }

    return $pixel->Pixel;
  }
}
