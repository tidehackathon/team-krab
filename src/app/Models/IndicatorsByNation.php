<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class IndicatorsByNation extends Model {

    protected $table = 'indicators_by_nations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['year', 'integral_indicators', 'tested_nations'];

}
