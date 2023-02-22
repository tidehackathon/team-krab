<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Nation extends Model {

    protected $table = 'nations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name"];

}
