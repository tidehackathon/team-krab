<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FocusArea extends Model {

    protected $table = 'focus_areas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name","is_operational_domain"];

}
