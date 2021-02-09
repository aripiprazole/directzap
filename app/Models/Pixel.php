<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pixel
 * @package App\Models
 * @property int id
 * @property string code
 * @property User $user
 */
class Pixel extends Model {
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'Pixel';

  /**
   * The primary key for the model.
   *
   * @var string
   */
  protected $primaryKey = 'ID';

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user',
    'code'
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
    return $this->attributes['Pixel'];
  }

  public function setCodeAttribute(string $code): void {
    $this->attributes['Pixel'] = $code;
  }
}
