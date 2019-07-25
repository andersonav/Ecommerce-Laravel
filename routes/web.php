<?php

use App\Produto;
use App\Carrinho;
use App\Pedido;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
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

    $categorias = DB::table('categoria')->where('ativo', '=', 1)->get();

    $produtos = Produto::select('produto.*', 'categoria.nome as categoriaNome')
        ->join('categoria', 'categoria_id', '=', 'categoria_id_fk')
        ->where("produto.ativo", '=', 1)
        ->get();

    return view('index', compact('returnDetails', 'valorTotalPedido', 'categorias', 'produtos', 'usuario'));
})->name('inicio');

Route::get('/singleProduct/{id}', 'ProdutoController@singleProduct')->name('singleProduct');
Route::get('/addPedido/{id}', 'PedidoController@addPedido')->name('addPedido');
Route::get('/verPedido', 'PedidoController@verPedido')->name('verPedido');
Route::post('/removerItem', 'PedidoController@removerItem')->name('removerItem');


Route::any('/notifications/ps', 'CompraController@ipnNotification')->name('pagseguro.notification');
Route::post('/pagsesdsdsds', 'NotificationController@notification')->name('pagseguro.redirect');
Route::post('/pagseguro', 'CompraController@payment')->name('api.pagseguro');
Route::get('/paymentVirtual', 'PedidoController@paymentVirtual')->name('paymentVirtual');
Route::get('/validarCupom', 'PedidoController@validarCupom')->name('validarCupom');

Route::get('/moedaVirtual/{cupom}', 'CupomControllerAPI@validarCupom')->name('validarCupomAPI');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
