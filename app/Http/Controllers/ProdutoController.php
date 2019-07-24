<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Pedido;
use App\Carrinho;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function singleProduct($id)
    {
        $returnDetails = array();
        $valorTotalPedido = 0;
        if (\Auth::check()) {
            $selectPedido = Pedido::where("status", '=', 'Em Andamento')
                ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
                ->get();

            if (count($selectPedido) != 0) {
                $idPedido = $selectPedido[0]->pedido_id;
                $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
                $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
            }
            $usuario = User::where("usuario_id", '=', Auth::user()->usuario_id)
                ->where('ativo', '=',  1)
                ->get();
        }

        $produto = Produto::select('produto.*', 'categoria.nome as categoriaNome')
            ->join('categoria', 'categoria_id', '=', 'categoria_id_fk')
            ->where("produto_id", '=', $id)
            ->where("produto.ativo", '=', 1)
            ->get();
        return view('single-product', compact('returnDetails', 'valorTotalPedido', 'produto', 'usuario'));
    }
}
