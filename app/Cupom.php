<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    protected  $table = "cupom";
    protected $primaryKey = "cupom_id";
    const CREATED_AT = "data_criacao";
    const UPDATED_AT = "data_atualizacao";

    protected $guarded = [];
}
