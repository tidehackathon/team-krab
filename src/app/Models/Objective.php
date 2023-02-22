<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Objective extends Model {

    protected $table = 'objectives';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["focus_area_id", "name", "title", "exercise_cycle"];

}
