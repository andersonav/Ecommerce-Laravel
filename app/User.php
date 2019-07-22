<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "usuario";
    protected $primaryKey = "usuario_id";
    const CREATED_AT = "data_criacao";
    const UPDATED_AT = "data_atualizacao";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    
}
