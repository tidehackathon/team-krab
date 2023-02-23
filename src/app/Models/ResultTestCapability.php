<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ResultTestCapability extends Model {

    protected $table = 'result_test_capabilities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["year", "all_value", "multidomain", "single"];
}
