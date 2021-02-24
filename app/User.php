<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 *
 * @property int id
 * @property string name
 * @property string surname
 * @property string email
 * @property string password
 * @property int status
 * @property int next
 * @property int totalCount
 * @property int fillCount
 * @property bool active
 * @property Configuration configuration
 */
class User extends Authenticatable {
  use HasApiTokens, Notifiable, HasRoles;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'surname',
    'email',
    'password',
    'status'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [];

  public function configuration(): HasOne {
    return $this->hasOne(Configuration::class);
  }

  public function collaborators(): HasMany {
    return $this->hasMany(Collaborator::class);
  }

  public function getFullNameAttribute(): string {
    return $this->name . ' ' . $this->surname;
  }

  public function getRoleAttribute(): string {
    return 'Member';
  }

  public function getActiveAttribute(): bool {
    return true;
  }

  public function hasCollaborators(): bool {
    return $this->collaborators()->exists();
  }

  public function overflow(): bool {
    return $this->collaborators()->count() > $this->configuration->max_collaborators;
  }
}
