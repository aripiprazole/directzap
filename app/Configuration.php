<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Configuration
 *
 * @package App
 * @property int maxCollaborators
 * @property int convPerUser
 * @property string pix
 */
class Configuration extends Model {
  use HasFactory;

  protected $fillable = [
    'pix',
    'conv_per_user',
    'max_collaborators'
  ];

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }
}
