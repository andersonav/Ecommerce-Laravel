<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PagSeguro;
use App\Carrinho;
use App\Pedido;
use Auth;
use App\User;
use DB;

class CompraController extends Controller
{
    public function payment(Request $request)
    {
        $selectUsuario = User::where("usuario_id", '=', Auth::user()->usuario_id)->get();
        $selectPedido = Pedido::where("status", '=', 'Em Andamento')
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
            ->get();


        $carrinho = Carrinho::where('pedido_id_fk', '=', $selectPedido[0]->pedido_id)
            ->join('produto', 'produto_id', 'produto_id_fk')
            ->get();
        $count = 0;
        $arrayItens = array();
        foreach ($carrinho as $produto) {
            $arrayItens[$count] = [
                'id' => $produto->produto_id_fk,
                'description' => $produto->descricao,
                'quantity' => $produto->quantidade_produto_carrinho,
                'amount' => intval($produto->valor * $produto->quantidade_produto_carrinho),
                'weight' => '45',
                'shippingCost' => '0',
            ];
            $count++;
        }
        $data = [
            'items' => $arrayItens,
            'shipping' => [
                'address' => [
                    'postalCode' => $selectUsuario[0]->cep,
                    'street' => $selectUsuario[0]->endereco,
                    'number' => $selectUsuario[0]->numero,
                    'district' => $selectUsuario[0]->bairro,
                    'city' => $selectUsuario[0]->cidade,
                    'state' => 'CE',
                    'country' => 'BRA',
                ],
                'type' => 2,
                'cost' => 30.4,
            ],
            'sender' => [
                'email' => $selectUsuario[0]->email,
                'name' => $selectUsuario[0]->nome,
                'documents' => [
                    [
                        'number' => $selectUsuario[0]->cpf,
                        'type' => 'CPF'
                    ]
                ],
                'phone' => [
                    'number' => '988355751',
                    'areaCode' => '85',
                ]
            ]
        ];

        try {
            $checkout = PagSeguro::checkout()->createFromArray($data);
            $credentials = PagSeguro::credentials()->get();
            $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information

            return redirect($information->getLink());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function ipnNotification(Request $request)
    {
        $email = 'annajessicaoficial@gmail.com';
        $token = 'fe39fe6a-3794-42c6-8ed8-67ed68dc414c2441dd3f4b058323f98dd9b155d8dabbcdc4-7756-41e5-838d-4f8699f04f55';

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $request->notificationCode . '?email=' . $email . '&token=' . $token;
        //Caso use sandbox descontente a linha abaixo.
        //$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $transaction = curl_exec($curl);
        curl_close($curl);

        if ($transaction == 'Unauthorized') {
            exit; //Mantenha essa linha
        }
        $transaction = simplexml_load_string($transaction);
        $status = $this->returnStatus($transaction->status);
        $forma = $this->returnForma($transaction->paymentMethod->type);
        $updateFatura = Fatura::where('id', '=', $transaction->items->item->id)->update([
            'forma' => $forma,
            'status' => $status
        ]);
        return response()->json(200);
    }

    public function returnStatus($inteiro)
    {
        $status = "";
        switch ($inteiro) {
            case 1:
                $status = "Aguardando pagamento";
                break;
            case 2:
                $status = "Em análise";
                break;
            case 3:
                $status = "Aprovado";
                break;
            case 4:
                $status = "Disponível";
                break;
            case 5:
                $status = "Em disputa";
                break;
            case 6:
                $status = "Devolvida";
                break;
            case 7:
                $status = "Cancelada";
                break;
        }
        return $status;
    }
    public function returnForma($inteiro)
    {
        $status = "";
        switch ($inteiro) {
            case 1:
                $status = "Cartão de crédito";
                break;
            case 2:
                $status = "Boleto";
                break;
            case 3:
                $status = "Débito online (TEF)";
                break;
            case 4:
                $status = "Saldo PagSeguro";
                break;
            case 5:
                $status = "Oi Paggo";
                break;
            case 7:
                $status = "Depósito em conta";
                break;
        }
        return $status;
    }
}
