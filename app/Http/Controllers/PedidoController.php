<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Carrinho;
use App\Pedido;
use App\User;
use Illuminate\Support\Facades\DB;
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
        $usuario = User::where("usuario_id", '=', Auth::user()->usuario_id)
            ->where('ativo', '=',  1)
            ->get();
        $returnDetails = array();
        $valorTotalPedido = array();
        if (count($selectPedido) != 0) {
            $idPedido = $selectPedido[0]->pedido_id;
            $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
            $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
        }

        return view('carrinho', compact('returnDetails', 'valorTotalPedido', 'usuario'));
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
    public function paymentVirtual()
    {
        $usuario = User::where("usuario_id", '=', Auth::user()->usuario_id)
            ->where('ativo', '=',  1)
            ->get();
        $selectPedido = Pedido::where("status", '=', 'Em Andamento')
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
            ->get();
        $response = array();
        if ($usuario[0]->saldo >= $selectPedido[0]->valorTotal) {
            if ($usuario[0]->saldo == 0 ||  $selectPedido[0]->valor_total == 0) {
                $response = [
                    "mensagem" => "Saldo insuficiente ou nenhum produto no carrinho!",
                    "tipoMensagem" => 'error'
                ];
            } else {
                $decrementSaldo = User::where("usuario_id", '=', Auth::user()->usuario_id)
                    ->decrement('saldo', $selectPedido[0]->valor_total);

                $updateStatusPedido = Pedido::where("pedido_id", '=', $selectPedido[0]->pedido_id)->update([
                    'status' => 'Aprovado'
                ]);
                $response = [
                    "mensagem" => "Pagamento através de moeda virtual realizado!",
                    "tipoMensagem" => 'success'
                ];
            }
        } else {
            $response = [
                "mensagem" => "Pagamento não realizado, pois saldo da moeda virtual é inferior ao valor da compra!",
                "tipoMensagem" => 'error'
            ];
        }
        return response()->json($response);
    }

    public function validarCupom(Request $request)
    {
        $selectCupom = DB::table('cupom')->where('identificador', '=', $request->valorCupom)->where('ativo', '=', 1)->get();
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
        return response()->json($response);
    }
}
