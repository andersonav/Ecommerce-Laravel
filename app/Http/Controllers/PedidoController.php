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
            $selectProdutoCarrinho = Carrinho::where("pedido_id_fk", '=', $idPedido)->where("produto_id_fk", '=', $id)->get();
            if (count($selectProdutoCarrinho) != 0) {
                $updateCarrinho = Carrinho::where("pedido_id_fk", '=', $idPedido)->where("produto_id_fk", '=', $id)->update([
                    'quantidade_produto_carrinho' => intval($selectProdutoCarrinho[0]->quantidade_produto_carrinho + 1)
                ]);
            } else {
                $insertCarrinho = Carrinho::create([
                    'produto_id_fk' => $id,
                    'pedido_id_fk' => $idPedido
                ]);
            }
        } else {
            $idPedido = Pedido::create([
                'status' => 'Em Andamento',
                'valor_total' => intval($valorProduto[0]->valor),
                'usuario_id_fk' =>  Auth::user()->usuario_id
            ])->pedido_id;

            $selectProdutoCarrinho = Carrinho::where("pedido_id_fk", '=', $idPedido)->where("produto_id_fk", '=', $id)->get();
            if (count($selectProdutoCarrinho) != 0) {
                $updateCarrinho = Carrinho::where("pedido_id_fk", '=', $idPedido)->where("produto_id_fk", '=', $id)->update([
                    'quantidade_produto_carrinho' => intval($selectProdutoCarrinho[0]->quantidade_produto_carrinho + 1)
                ]);
            } else {
                $insertCarrinho = Carrinho::create([
                    'produto_id_fk' => $id,
                    'pedido_id_fk' => $idPedido
                ]);
            }
        }

        $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
        $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
        return redirect()->route('verPedido');
        // return view('carrinho', compact('returnDetails', 'valorTotalPedido'));
    }
    public function verPedido()
    {
        $selectPedido = Pedido::where("status", '=', 'Em Andamento')
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
            ->get();
        $idPedido = $selectPedido[0]->pedido_id;
        $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
        $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
        return view('carrinho', compact('returnDetails', 'valorTotalPedido'));
    }
    public function removerItem(Request $request)
    {
        $selectProdutoCarrinho = Carrinho::where("carrinho_id", '=', $request->carrinhoId)->join("produto", 'produto_id', 'produto_id_fk')->get();
        $valorDecrementado = intval($selectProdutoCarrinho[0]->quantidade_produto_carrinho * $selectProdutoCarrinho[0]->valor);

        $deleteProdutoCarrinho = Carrinho::where("carrinho_id", '=', $request->carrinhoId)->delete();

        $decrementPedido = Pedido::where("pedido_id", '=', $request->pedidoId)
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)->decrement('valor_total', $valorDecrementado);
        echo response()->json($decrementPedido);
    }
}
