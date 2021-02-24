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
 * @property int status
 * @property User user
 * @property int fill_count
 * @property int total_count
 * @property bool active
 */
class Collaborator extends Model {
  use HasFactory;

  public const ACTIVE = 0;
  public const PAUSED = 1;

  protected $fillable = [
    'name', 'message',
    'email', 'phone',
    'count', 'status',
    'user', 'fill_count',
    'total_count'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public function getActiveAttribute(): bool {
    return $this->status == self::ACTIVE && $this->user->active;
  }

  public function invert(): int {
    if ($this->status == self::ACTIVE) {
      return self::PAUSED;
    } else {
      return self::ACTIVE;
    }
  }
}
