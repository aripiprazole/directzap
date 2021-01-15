<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Configuration
 * @package App\Models
 * @property int $id
 * @property int $vezes
 * @property int $maxCollaborators
 * @property User $user
 */
class Config extends Model {
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'configuracoes';

  /**
   * Indicates if the IDs are auto-incrementing.
   *
   * @var bool
   */
  public $incrementing = false;

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
    'user',
    'vezes',
    'maxCollaborators'
  ];

  // mutators
  public function getUserAttribute() {
    return User::query()->where('email', $this->attributes['email'])->firstOrFail();
  }

  public function setUserAttribute(User $user): void {
    $this->attributes['email'] = $user->email;
  }
}
