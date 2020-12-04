<?php

namespace App\Models;

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
    'id',
    'password',
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

  public function collaborators() {
    return Collaborator::query()->where('email', $this->email)->get();
  }

  public function getAuthIdentifier() {
    return $this->email;
  }

  // mutators
  public function getFullNameAttribute(): string {
    return $this->name . ' ' . $this->surname;
  }

  public function getIsActivatedAttribute() {
    return $this->created_at->addMonth()->greaterThanOrEqualTo(now());
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

  public function getCreatedAtAttribute() {
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
