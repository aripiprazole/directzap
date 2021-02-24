<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Collaborator
 *
 * @package App
 *
 * @property int id
 * @property string name
 * @property string message
 * @property string phone
 * @property int count
 * @property int status
 * @property User user
 */
class Collaborator extends Model {
  use HasFactory;

  public const ACTIVE = 0;
  public const PAUSED = 1;

  protected $fillable = [
    'name', 'message',
    'email', 'phone',
    'count', 'status',
    'user'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public function getActiveAttribute(): bool {
    return $this->status == self::ACTIVE;
  }

  public function invert(): int {
    if ($this->status == self::ACTIVE) {
      return self::PAUSED;
    } else {
      return self::ACTIVE;
    }
  }
}
