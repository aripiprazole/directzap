<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Activation
 * @package App
 * @property string code
 * @property string type
 * @property bool used
 * @property bool expired
 * @property User|null user
 */
class Activation extends Model {
  use HasFactory;

  protected $fillable = [
    'code',
    'type',
    'used',
    'expired'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public static function findByCode($code): Activation {
    /** @var Activation $activation */
    $activation = self::query()->where('code', $code)->first();

    return $activation;
  }
}
