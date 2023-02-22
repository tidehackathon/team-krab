<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ResulTestParticipant extends Model {

    protected $table = 'result_test_participants';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["year", "all_value", "limited_success", "interoperability_issue", "not_tested", "success", "pending"];
}
