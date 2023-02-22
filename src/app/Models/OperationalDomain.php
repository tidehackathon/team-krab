<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OperationalDomain extends Model {

    protected $table = 'operational_domains';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ["name"];

}
