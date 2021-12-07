<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class Stats
{
  public $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  /* get 7 last days */
  public function getNineDates($format)
  {
    $today_subs = [
      Carbon::now()->format($format),
      Carbon::now()->subDays(1)->format($format),
      Carbon::now()->subDays(2)->format($format),
      Carbon::now()->subDays(3)->format($format),
      Carbon::now()->subDays(4)->format($format),
      Carbon::now()->subDays(5)->format($format),
      Carbon::now()->subDays(6)->format($format),
      Carbon::now()->subDays(7)->format($format),
      Carbon::now()->subDays(8)->format($format)
    ];
    return $today_subs;
  }

  /* get new user 7 last days */
  public function getNewStatOf($model)
  {
    $models = $model::where('created_at', '>', Carbon::now()->subDays(8))->get();
    $tomorrow = Carbon::tomorrow()->format('Y-m-d');
    $today_subs = $this->getNineDates('Y-m-d');
    $new_models_count = [
      $models->whereBetween('created_at', [$today_subs[0], $tomorrow])->count(),
      $models->whereBetween('created_at', [$today_subs[1], $today_subs[0]])->count(),
      $models->whereBetween('created_at', [$today_subs[2], $today_subs[1]])->count(),
      $models->whereBetween('created_at', [$today_subs[3], $today_subs[2]])->count(),
      $models->whereBetween('created_at', [$today_subs[4], $today_subs[3]])->count(),
      $models->whereBetween('created_at', [$today_subs[5], $today_subs[4]])->count(),
      $models->whereBetween('created_at', [$today_subs[6], $today_subs[5]])->count(),
      $models->whereBetween('created_at', [$today_subs[7], $today_subs[6]])->count(),
      $models->whereBetween('created_at', [$today_subs[8], $today_subs[7]])->count()
    ];
    return $new_models_count;
  }

  public function total($model)
  {
    return $model::all()->count();
  }

  public function todayCount($model)
  {
    return $model::whereBetween('created_at', [Carbon::now()->format("Y-m-d"), Carbon::tomorrow()->format('Y-m-d')])->count();
  }
}
