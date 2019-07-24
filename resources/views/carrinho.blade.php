@extends('layouts.painel')
@section('conteudo')
<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{asset('images/bg/2.jpg')}}) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Carrinho</h2>
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="{{route('inicio')}}">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb-item active">Cart</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area start -->
<div class="cart-main-area ptb--120 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="{{route('api.pagseguro')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Imagem</th>
                                    <th class="product-name">Produto</th>
                                    <th class="product-price">Preço</th>
                                    <th class="product-quantity">Quantidade</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($returnDetails as $produto)
                                <tr id="produtos">
                                    <td class="product-thumbnail"><a href="#"><img src="{{asset('images/product/4.png')}}" alt="product img" /></a></td>
                                    <td class="product-name"><a href="#">{{$produto->nome}}</a></td>
                                    <td class="product-price"><span class="amount">R$ {{$produto->valor}}</span></td>
                                    <td class="product-quantity"><input type="number" value="{{$produto->quantidade_produto_carrinho}}" /></td>
                                    <td class="product-subtotal">{{$produto->valor * $produto->quantidade_produto_carrinho}}</td>
                                    <td class="product-remove"><a href="#" onclick="removerItem({{$produto->carrinho_id}}, {{$produto->pedido_id_fk}}, '{{$produto->nome}}')">X</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Não há produtos no carrinho</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="buttons-cart">
                                <a href="{{route('inicio')}}">Continuar Comprando</a>
                            </div>
                            <div class="coupon">
                                <h3>Cupom</h3>
                                <p>Digite um cupom para atualizar sua moeda virtual.</p>
                                <input type="text" placeholder="Código do cupom" id="cupom"/>
                                <input type="button" id="btnCupom" value="Aplicar Cupom" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12">
                            <div class="cart_totals">
                                <h2>Total da Compra</h2>
                                <table>
                                    <tbody>
                                        <!-- <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">£215.00</span></td>
                                        </tr> -->
                                        <!-- <tr class="shipping">
                                            <th>Shipping</th>
                                            <td>
                                                <ul id="shipping_method">
                                                    <li>
                                                        <input type="radio" />
                                                        <label>
                                                            Flat Rate: <span class="amount">£7.00</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" />
                                                        <label>
                                                            Free Shipping
                                                        </label>
                                                    </li>
                                                    <li></li>
                                                </ul>
                                                <p><a class="shipping-calculator-button" href="#">Calculate Shipping</a></p>
                                            </td>
                                        </tr> -->
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong><span class="amount">{{$valorTotalPedido[0]->valor_total or 0}}</span></strong>
                                                <br /><br />
                                                <div class="wc-proceed-to-checkout" id="btnCheckout" style="display:none;">
                                                    <button id="btnPageLogin" type="submit">Pagar</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($("tr#produtos").length == 0) {
            $("#btnCheckout").hide();
        } else {
            $("#btnCheckout").show();
        }
    });
</script>
@endsection