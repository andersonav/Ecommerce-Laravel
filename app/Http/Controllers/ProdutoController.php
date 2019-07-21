<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ProdutoController extends Controller
{
    public function singleProduct($id)
    {
        $produto = Produto::select('produto.*', 'categoria.nome as categoriaNome')
        ->join('categoria', 'categoria_id', '=', 'categoria_id_fk')
        ->where("produto_id", '=', $id)
        ->where("produto.ativo", '=', 1)
        ->get();
        return view('single-product', compact('produto'));
    }
}
