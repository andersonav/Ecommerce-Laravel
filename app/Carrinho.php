<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected  $table = "carrinho";
    protected $primaryKey = "carrinho_id";
    const CREATED_AT = "data_criacao";
    const UPDATED_AT = "data_atualizacao";

    protected $guarded = [];
}
