<?php

namespace Diskominfo\Model;

use Illuminate\Database\Eloquent\Model;

class User  extends Model
{
    protected $primaryKey = "id_user";
    public $timestamps = false;

    public function getRole()
    {
        return $this->belongsTo("Diskominfo\Model\Role", "id_role");
    }

    public function getOpd()
    {
        return $this->belongsTo("Diskominfo\Model\Opd", "id_opd");
    }
}
