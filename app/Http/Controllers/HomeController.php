<?php

namespace App\Http\Controllers;

use App\Carrinho;
use App\Pedido;
use App\User;
use Illuminate\Support\Facades\Validator;
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
        $historico = Pedido::where("usuario_id_fk", '=', Auth::user()->usuario_id)->get();

        return view('home', compact('returnDetails', 'valorTotalPedido', 'usuario', 'historico'));
    }
    public function editarDados(Request $request)
    {
        if ($request->password != "") {
            $this->validator($request);
            $update = User::where("usuario_id", '=', Auth::user()->usuario_id)->update([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'cpf' => $request->cpf,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
            ]);
        } else {
            $this->validator2($request);
            $update = User::where("usuario_id", '=', Auth::user()->usuario_id)->update([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
                'bairro' => $request->bairro,
            ]);
        }
        return redirect()->route('home');
    }

    protected function validator(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|max:255',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:6|confirmed',
            'cpf' => 'required|max:255',
            'cep' => 'required|max:255',
            'endereco' => 'required|max:255',
            'numero' => 'required|max:255',
            'cidade' => 'required|max:255',
            'bairro' => 'required|max:255',
        ]);
        return $validatedData;
    }
    protected function validator2(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|max:255',
            'email' => 'required|string|email|max:255|',
            'cpf' => 'required|max:255',
            'cep' => 'required|max:255',
            'endereco' => 'required|max:255',
            'numero' => 'required|max:255',
            'cidade' => 'required|max:255',
            'bairro' => 'required|max:255',
        ]);
        return $validatedData;
    }
}
