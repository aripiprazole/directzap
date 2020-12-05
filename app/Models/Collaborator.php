<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Collaborator
 * @package App\Models
 * @property int id
 * @property string $name
 * @property string $person_link
 * @property string $link
 * @property string $message
 * @property string $phone
 * @property string $email
 * @property bool $paused
 * @property int $counter
 */
class Collaborator extends Model {
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'colaboradores';

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
   * @var string[]
   */
  protected $fillable = [
    'name',
    'person_link',
    'link',
    'message',
    'phone',
    'email',
    'counter',
    'paused',
  ];

  /**
   * The model's attributes.
   *
   * @var array
   */
  protected $attributes = [
    'contador' => 0,
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'paused' => 'bool'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'id',
  ];

  // mutators
  public function getTotalCountAttribute() {
    return SellerStatistic::query()
      ->where('id_vendedor', $this->id)
      ->count();
  }

  public function getPausedAttribute(): bool {
    /** @var User $user */
    $user = User::query()->where('email', $this->email)->firstOrFail();

    return !$user->is_activated && $this->attributes['paused'] === 1;
  }

  public function getCounterAttribute(): int {
    return $this->attributes['contador'];
  }

  public function setCounterAttribute(int $counter): void {
    $this->attributes['contador'] = $counter;
  }

  public function getNameAttribute(): string {
    return $this->attributes['nome'];
  }

  public function setNameAttribute(string $name): void {
    $this->attributes['nome'] = $name;
  }

  public function getPersonLinkAttribute(): string {
    return $this->attributes['linkpessoa'];
  }

  public function setPersonLinkAttribute(string $personLink): void {
    $this->attributes['linkpessoa'] = $personLink;
  }

  public function getMessageAttribute(): string {
    return $this->attributes['mensagem'];
  }

  public function setMessageAttribute(string $message): void {
    $this->attributes['mensagem'] = $message;
  }

  public function getPhoneAttribute(): int {
    return strval($this->attributes['telefone']);
  }

  public function setPhoneAttribute(string $phone): void {
    $this->attributes['telefone'] = intval($phone);
  }
}
