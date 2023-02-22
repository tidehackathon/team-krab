<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TestObjective extends Model {

    protected $table = 'test_objectives';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["testcase_id", "objective_id", "exercise_cycle"];

}
