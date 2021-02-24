<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Configuration
 *
 * @package App
 * @property int max_collaborators
 * @property int conv_per_user
 * @property string code
 * @property string pix
 * @property User user
 */
class Configuration extends Model {
  use HasFactory;

  protected $fillable = [
    'pix',
    'conv_per_user',
    'code',
    'max_collaborators'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public static function findByCode($code): ?Configuration {
    /** @var Configuration $configuration */
    $configuration = self::query()->where('code', $code)->first();

    return $configuration;
  }

  public function generateUrl(string $access): string {
    $urls = [
      'facebook' => config('app.facebook.url') . "?cod={$this->code}",
      'direct' => route('conversion', ['cod' => $this->code])
    ];

    return $urls[$access] ?? 'NULL';
  }
}
