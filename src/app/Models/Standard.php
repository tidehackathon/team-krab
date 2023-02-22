<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Standard extends Model {

    protected $table = 'standards';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name", "title", "type"];

}
