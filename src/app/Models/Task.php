<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model {

    protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name"];

}
