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
            <button class="active" data-filter=".cat2">Acessórios-Brinquedos</button>
            <button data-filter=".cat3">Enlatados Sachês</button>
            <button data-filter=".cat5">Higiene/Beleza</button>
            <button data-filter=".cat6">Medicamentos</button>
            <button data-filter=".cat7">Promoções</button>
            <button data-filter=".cat8">Rações</button>
        </div>
        <div class="portfolio-style">
            <div class="row grid">
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat2 cat3">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/1.jpg" alt="" />
                            </a>
                            <!-- <div class="portfolio-icon">
                                <a class="img-poppu" href="images/portfolio/equal/2.jpg">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            </div> -->
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <div class="shp__pro__details" style="margin-bottom:20px;">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <ul class="shopping__btn">
                                <li class="shp__checkout"><a href="{{route('singleProduct', ['id' => 1])}}">Ver Detalhes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat5 cat2">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/2.jpg" alt="" />
                            </a>
                            <div class="portfolio-icon">
                                <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                    <i class="zmdi zmdi-videocam"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <h3><a href="single-portfolio.html">TITLE GOES HERE</a></h3>
                            <span>Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat2 cat3">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/3.jpg" alt="" />
                            </a>
                            <div class="portfolio-icon">
                                <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                    <i class="zmdi zmdi-videocam"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <h3><a href="single-portfolio.html">TITLE GOES HERE</a></h3>
                            <span>Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat5 cat2">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/4.jpg" alt="" />
                            </a>
                            <div class="portfolio-icon">
                                <a class="img-poppu" href="images/portfolio/equal/2.jpg">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <h3><a href="single-portfolio.html">TITLE GOES HERE</a></h3>
                            <span>Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat2 cat5">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/5.jpg" alt="" />
                            </a>
                            <div class="portfolio-icon">
                                <a class="video-popup" href="https://www.youtube.com/watch?v=cDDWvj_q-o8">
                                    <i class="zmdi zmdi-videocam"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <h3><a href="single-portfolio.html">TITLE GOES HERE</a></h3>
                            <span>Design</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 grid-item cat3 cat5">
                    <div class="single-portfolio-card mb--30">
                        <div class="portfolio-img">
                            <a href="single-portfolio.html">
                                <img src="images/portfolio/equal/6.jpg" alt="" />
                            </a>
                            <div class="portfolio-icon">
                                <a class="img-poppu" href="images/portfolio/equal/2.jpg">
                                    <i class="zmdi zmdi-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <div class="portfolio-title portfolio-card-title text-center">
                            <h3><a href="single-portfolio.html">TITLE GOES HERE</a></h3>
                            <span>Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection