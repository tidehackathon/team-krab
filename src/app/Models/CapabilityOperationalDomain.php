<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CapabilityOperationalDomain extends Model {

    protected $table = 'capability_operational_domains';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["capability_id", "operational_domain_id"];

    /**
     * Belongs to capability.
     */
    public function capability()
    {
        return $this->belongsTo(Capability::class);
    }
}
