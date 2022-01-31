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
 * @property string image
 * @property string role
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
    'status',
    'role'
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

  public function activations(): HasMany {
    return $this->hasMany(Activation::class);
  }

  public function collaborators(): HasMany {
    return $this->hasMany(Collaborator::class);
  }

  public function getFullNameAttribute(): string {
    return $this->name . ' ' . $this->surname;
  }

  public function getRoleAttribute(): string {
    return $this->hasRole('Administrator') ? 'Administrator' : 'Member';
  }

  public function getAvatarAttribute(): string {
    return route('dashboard.users.avatar', ['user' => $this->id]);
  }

  public function hasRole($roles, string $guard = null): bool {
    return $this->getRoleAttribute() === $roles;
  }

  public function getActiveAttribute(): bool {
    if($this->hasRole('Administrator')) {
      return true;
    }

    /** @var Activation $activation */
    $activation = $this->activations()
      ->where('used', 1)
      ->whereRaw("
        (DATE_ADD(created_at, INTERVAL 30 DAY) > NOW() AND type = 'manual')
          OR (expired = 0 AND type = 'automatic')
          OR (expired = 0 AND type = 'infinite')")
      ->first();

    if ($activation == null) {
      return false;
    }

    return $activation != null;
  }

  public function hasCollaborators(): bool {
    return $this->collaborators()->exists();
  }

  public function overflow(): bool {
    return $this->collaborators()->count() > $this->configuration->max_collaborators;
  }
}
