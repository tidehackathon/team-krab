<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class WarfareLevel extends Model {

    protected $table = 'warfare_levels';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name"];

}
