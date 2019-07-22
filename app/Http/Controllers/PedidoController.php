<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Carrinho;
use App\Pedido;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addPedido($id)
    {
        $selectPedido = Pedido::where("status", '=', 'Em Andamento')
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
            ->get();
        $valorProduto = Produto::where("produto_id", '=', $id)->where("ativo", '=', 1)->get();
        if (count($selectPedido) != 0) {
            $idPedido = $selectPedido[0]->pedido_id;
            $valorTotal = $selectPedido[0]->valor_total + $valorProduto[0]->valor;
            $updateValorTotal = Pedido::where("pedido_id", '=', $idPedido)->update([
                'valor_total' => intval($valorTotal)
            ]);
            $insertCarrinho = Carrinho::create([
                'produto_id_fk' => $id,
                'pedido_id_fk' => $idPedido
            ]);
        } else {
            $idPedido = Pedido::create([
                'status' => 'Em Andamento',
                'valor_total' => intval($valorProduto[0]->valor),
                'usuario_id_fk' =>  Auth::user()->usuario_id
            ])->pedido_id;

            $insertCarrinho = Carrinho::create([
                'produto_id_fk' => $id,
                'pedido_id_fk' => $idPedido
            ]);
        }

        $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
        $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
        return view('carrinho', compact('returnDetails', 'valorTotalPedido'));
    }
}
