<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Code
 * @package App\Models
 * @property int $id
 * @property string $code
 * @property User $user
 */
class Code extends Model {
  use HasFactory;

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Codigo';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'code',
    'user'
  ];

  // mutators
  public function getIdAttribute() {
    return $this->attributes['ID'];
  }

  public function getUserAttribute() {
    return User::query()->where('email', $this->attributes['Email'])->firstOrFail();
  }

  public function setUserAttribute(User $user): void {
    $this->attributes['Email'] = $user->email;
  }

  public function getCodeAttribute(): string {
    return $this->attributes['Codigo'];
  }

  public function setCodeAttribute(string $code): void {
    $this->attributes['Codigo'] = $code;
  }
}
