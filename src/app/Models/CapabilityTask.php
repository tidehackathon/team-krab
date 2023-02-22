<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CapabilityTask extends Model {

    protected $table = 'capability_tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["capability_id", "task_id"];
}
