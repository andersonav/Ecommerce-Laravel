@extends('layouts.painel')
@section('conteudo')
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Ecommerce destinado ao Pet</h2>
                        <!-- <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.html">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active"></span>
                        </nav> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-grid-area bg__white pt--130 pb--100">
    <div class="container">
        <div class="portfolio-menu-active gutter-btn mb--50 text-center">
            <!-- Categorias -->
            <!-- <button class="active" data-filter="*">Todos</button> -->
            @php
            $contador = 0;
            @endphp
            @foreach($categorias as $categoria)
            @if($contador == 0)
            <button class="active" data-filter="">Todos</button>
            <button data-filter=".categoria{{$categoria->categoria_id}}">{{$categoria->nome}}</button>
            @else
            <button data-filter=".categoria{{$categoria->categoria_id}}">{{$categoria->nome}}</button>
            @endif
            @php
            $contador++;
            @endphp
            @endforeach
        </div>
        <div class="portfolio-style">
            <div class="row grid">
                @foreach($produtos as $produto)
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item categoria{{$produto->categoria_id_fk}}">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="{{asset('images/'.$produto->imagem)}}" alt="" />
                            </a>
                            <!-- <div class="portfolio-icon">
                                <a class="img-poppu" href="images/portfolio/equal/2.jpg">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            </div> -->
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <div class="shp__pro__details" style="margin-bottom:20px;">
                                <h2><a href="javascript:void(0);">{{$produto->nome}}</a></h2>
                                <span class="shp__price">R$ {{$produto->valor}}</span>
                            </div>
                            <ul class="shopping__btn">
                                <li class="shp__checkout"><a href="{{route('singleProduct', ['id' => $produto->produto_id])}}">Ver Detalhes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection