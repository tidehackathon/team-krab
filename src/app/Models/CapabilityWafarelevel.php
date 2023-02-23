<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CapabilityWafarelevel extends Model {

    protected $table = 'capability_warfarelevels';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["capability_id","warfarelevel_id"];
}
