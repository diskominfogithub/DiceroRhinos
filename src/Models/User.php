<?php

namespace Diskominfo\Model;
use Illuminate\Database\Eloquent\Model;

class User  extends Model{
    protected $table = "user";
    public $timestamps = false;

    public function getRole(){
        return $this->belongsTo("Diskominfo\Model\Role");
    }

    public function getOpd(){
        return $this->belongsTo("Diskominfo\Model\Opd");
    }
}