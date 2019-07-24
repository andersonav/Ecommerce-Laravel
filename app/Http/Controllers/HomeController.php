<?php

namespace App\Http\Controllers;

use App\Carrinho;
use App\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $selectPedido = Pedido::where("status", '=', 'Em Andamento')
            ->where('usuario_id_fk', '=',  Auth::user()->usuario_id)
            ->get();
        $idPedido = $selectPedido[0]->pedido_id;
        $returnDetails = Carrinho::where("pedido_id_fk", '=', $idPedido)->join("produto", 'produto_id', 'produto_id_fk')->get();
        $valorTotalPedido = Pedido::where("pedido_id", '=', $idPedido)->get();
        return view('home', compact('returnDetails', 'valorTotalPedido'));
    }
}
