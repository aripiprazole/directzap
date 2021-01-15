<?php

namespace App\Models;

use App\Services\ConfigService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $full_name
 * @property string $password
 * @property string $email
 * @property string $status
 * @property bool $is_activated
 * @property int $role
 * @property Carbon $created_at
 * @property int $next
 */
class User extends Authenticatable {
  use HasFactory, Notifiable;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'usuarios';

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
    'name',
    'surname',
    'email',
    'role',
    'status',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'senha'
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [];

  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public $timestamps = false;

  /**
   * The model's attributes.
   *
   * @var array
   */
  protected $attributes = [
    'role' => 1,
    'status' => 'Desativado',
    'next' => -1
  ];

  public function getCollaboratorOverflowAttribute(): bool {
    /** @var ConfigService $configService */
    $configService = app(ConfigService::class);

    /** @var Collaborator $collaborator */
    $collaborator = Collaborator::query()
      ->where('email', $this->email)
      ->where('paused', '!=', 1)
      ->where('id', '>', $this->next)
      ->first();

    if ($collaborator == null) {
      return false;
    }

    $all = Collaborator::query()->where('email', $user->email)->get();

    $index = $all->search(function (Collaborator $item) use ($collaborator) {
      return $item->id == $collaborator->id;
    });

    return $index >= $configService->findMaxCollaboratorsByEmail($this->email);
  }

  public function getMaxCollaboratorsAttribute(): bool {
    /** @var ConfigService $configService */
    $configService = app(ConfigService::class);

    return $configService->findMaxCollaboratorsByEmail($this->email);
  }

  public function collaborators() {
    return Collaborator::query()->where('email', $this->email)->get();
  }

  public function getAuthIdentifier(): string {
    return $this->email;
  }

  // mutators
  public function getFullNameAttribute(): string {
    return $this->name . ' ' . $this->surname;
  }

  public function getIsActivatedAttribute(): bool {
    /** @var Activation $activation */
    $activation = Activation::query()->where('email', $this->email)->first();
    if ($activation == null) {
      return false;
    }
    return $activation->createdAt->addDays(30)->isBefore(now());
  }

  public function getNameAttribute(): string {
    return $this->attributes['nome'];
  }

  public function setNameAttribute($name): void {
    $this->attributes['nome'] = $name;
  }

  public function getSurnameAttribute(): string {
    return $this->attributes['Sobrenome'];
  }

  public function setSurnameAttribute(string $surname): void {
    $this->attributes['Sobrenome'] = $surname;
  }

  public function getCreatedAtAttribute(): Carbon {
    return Carbon::createFromTimestamp(strtotime($this->attributes['tempo']));
  }

  public function setCreatedAtAttribute(Carbon $createdAt): void {
    $this->attributes['tempo'] = $createdAt;
  }

  public function getPasswordAttribute(): string {
    return $this->attributes['senha'];
  }

  public function setPasswordAttribute(string $password): void {
    $this->attributes['senha'] = Hash::make($password);
  }
}
