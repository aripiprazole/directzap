<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activation
 * @property Carbon createdAt
 * @package App\Models
 */
class Activation extends Model {
  use HasFactory;

  protected $fillable = [
    'email',
    'code',
    'is_activated',
    'automatic',
    'expired'
  ];

  public static function code(): string {
    return hash('sha256', now()->unix());
  }
}
