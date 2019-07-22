<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected  $table = "pedido";
    protected $primaryKey = "pedido_id";
    const CREATED_AT = "data_criacao";
    const UPDATED_AT = "data_atualizacao";

    protected $guarded = [];
}
