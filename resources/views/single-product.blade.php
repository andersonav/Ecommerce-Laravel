@extends('layouts.painel')
@section('conteudo')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('images/bg/2.jpg')}}) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Ecommerce Pet</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{ url()->previous() }}">Início</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">Detalhes Produto</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<div class="single-portfolio-area bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="single-portfolio-img">
                    <img src="{{asset('images/'.$produto[0]->imagem)}}" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="portfolio-description mrg-sm">
                    <h2>{{$produto[0]->nome}}</h2>
                    <p>{{$produto[0]->descricao}}</p>
                    <div class="portfolio-info">
                        <ul class="shopping__btn">
                            <li><span>Categoria:</span>{{$produto[0]->categoriaNome}}</li>
                            <li><span>Quantidade em Estoque:</span>{{$produto[0]->quantidade}}</li>
                            <li><span>Valor em reais:</span>R$ {{$produto[0]->valor}}</li>
                            <li class="shp__checkout"><a href="{{route('addPedido', ['id' => $produto[0]->produto_id])}}">Adicionar ao Carrinho</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection