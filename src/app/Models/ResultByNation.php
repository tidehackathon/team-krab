<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ResultByNation extends Model {

    protected $table = 'result_by_nations';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["year", "not_tested", "limited_success", "interoperability_issue", "not_tested", "success", "pending", "all", "ratio", "md", "sd", "capab_count", "domains_id", "rank"];

}
