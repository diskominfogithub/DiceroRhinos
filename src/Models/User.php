<?php

namespace Diskominfo\Model;
use Illuminate\Database\Eloquent\Model;

class User  extends Model{
    protected $table = "user";
    protected $primaryKey = "username";
    public $timestamps = false;
}