<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TestParticipant extends Model {

    protected $table = 'test_participants';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["capability_id", "testcase_id", "exercise_cycle","participant_role","participant_result"];


    /**
     * Belongs to capability.
     */
    public function capability()
    {
        return $this->belongsTo(Capability::class);
    }


}
