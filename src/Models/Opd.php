<?php

namespace Diskominfo\Model;
use Illuminate\Database\Eloquent\Model;

class Opd  extends Model{
    protected $table = "opd";
    protected $primaryKey = "id_opd";
    public $timestamps = false;
}