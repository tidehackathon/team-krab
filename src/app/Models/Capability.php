<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Capability extends Model {

    protected $table = 'capabilities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["nation_id", "name", "maturity"];

    /**
     * Get the Test Participants for the Capability.
     */
    public function testParticipants()
    {
        return $this->hasMany(TestParticipant::class);
    }

    /**
     * Get the Capability Operational Domain for the Capability.
     */
    public function capabilityOperationalDomain()
    {
        return $this->hasMany(CapabilityOperationalDomain::class);
    }

}
