<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SellerStatistic
 * @package App\Models
 * @property int id
 * @property Collaborator $collaborator
 * @property int $total_counter
 * @property Carbon $accessed_at
 */
class SellerStatistic extends Model {
  use HasFactory;

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'estatistica_vendedores';

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
    'collaborator',
    'total_counter',
    'accessed_at'
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
  public function getCollaboratorAttribute() {
    return Collaborator::query()->findOrFail($this->attributes['id_vendedor']);
  }

  public function setCollaboratorAttribute(Collaborator $collaborator): void {
    $this->attributes['id_vendedor'] = $collaborator->id;
  }

  public function getTotalCounterAttribute(): int {
    return $this->attributes['contador_total'];
  }

  public function setTotalCounterAttribute(int $totalCounter): void {
    $this->attributes['contador_total'] = $totalCounter;
  }

  public function getAccessedAtAttribute(): Carbon {
    return $this->attributes['data_acesso'];
  }

  public function setAccessedAtAttribute(string $accessedAt): void {
    $this->attributes['data_acesso'] = $accessedAt;
  }
}
