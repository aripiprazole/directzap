<?php


namespace App\Services;


use App\Models\Collaborator;
use App\Models\SellerStatistic;

class StatisticService {

  public function report(Collaborator $collaborator) {
    SellerStatistic::query()->create([
      'collaborator' => $collaborator,
      'total_counter' => $collaborator->counter,
      'accessed_at' => now()
    ]);
  }

}
