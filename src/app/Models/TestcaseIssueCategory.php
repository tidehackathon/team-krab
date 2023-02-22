<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TestcaseIssueCategory extends Model {

    protected $table = 'testcase_issue_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["testcase_id","issue_category_id"];

}
