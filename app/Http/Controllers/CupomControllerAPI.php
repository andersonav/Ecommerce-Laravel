<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Carrinho;
use App\Pedido;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CupomControllerAPI extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validarCupom($cupom)
    {
        $selectCupom = DB::table('cupom')->where('identificador', '=', $cupom)->where('ativo', '=', 1)->get();
        $response = array();
        if (count($selectCupom) != 0) {
            $incrementSaldo = User::where("usuario_id", '=', Auth::user()->usuario_id)
                ->increment('saldo', $selectCupom[0]->valor);


            $updateCupom = DB::table('cupom')->where("cupom_id", '=', $selectCupom[0]->cupom_id)->update([
                'ativo' => 0
            ]);

            $response = [
                "mensagem" => "Cupom adicionado com sucesso!",
                "tipoMensagem" => 'success'
            ];
            
        } else {
            $response = [
                "mensagem" => "Cupom inválido ou já utilizado. Por favor digite um novo cupom!",
                "tipoMensagem" => 'error'
            ];
        }
        return redirect()->route('inicio');
    }
}
