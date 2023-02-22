<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Testcase extends Model {

    protected $table = 'testcases';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["tc_number","exercise_cycle","title","overall_result", "io_shortfall_ind"];

}
