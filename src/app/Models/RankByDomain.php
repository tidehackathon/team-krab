<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RankByDomain extends Model {

    protected $table = 'rank_by_domains';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["year", "not_tested", "limited_success", "interoperability_issue", "not_tested", "success", "pending", "all", "ratio", "md", "sd", "capab_count", "domains_id", "rank"];

}
