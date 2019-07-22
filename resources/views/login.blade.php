@extends('layouts.painel')
@section('conteudo')
<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu" role="tablist">
                    <li role="presentation" class="login active"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
                    <li role="presentation" class="register"><a href="#register" role="tab" data-toggle="tab">Registrar</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                        <form class="login" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">Email</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">Senha</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="htc__login__btn mt--30">
                                <button id="btnPageLogin" type="submit">Entrar</button>
                            </div>
                        </form>
                    </div>
                    <!-- End Single Content -->
                    <!-- Start Single Content -->
                    <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade">
                        <form class="login" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                <label for="nome" class="col-md-12 control-label">Nome</label>
                                <div class="col-md-12">
                                    <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" required>

                                    @if ($errors->has('nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                                <label for="telefone" class="col-md-12 control-label">Telefone</label>
                                <div class="col-md-12">
                                    <input id="telefone" type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" required>

                                    @if ($errors->has('telefone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-12 control-label">Email</label>
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-12 control-label">Senha</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-12 control-label">Confirmar Senha</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <br />
                            </div>
                            <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
                                <label for="cpf" class="col-md-12 control-label">CPF</label>
                                <div class="col-md-12">
                                    <input id="cpf" type="text" class="form-control" name="cpf" value="{{ old('cpf') }}" required>

                                    @if ($errors->has('cpf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cpf') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                <label for="cep" class="col-md-12 control-label">CEP</label>
                                <div class="col-md-12">
                                    <input id="cep" type="text" class="form-control" name="cep" value="{{ old('cep') }}" required onkeyup="getCEP(this);">

                                    @if ($errors->has('cep'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cep') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                <label for="endereco" class="col-md-12 control-label">Endereço</label>
                                <div class="col-md-12">
                                    <input id="endereco" type="text" class="form-control" name="endereco" value="{{ old('endereco') }}" required>

                                    @if ($errors->has('endereco'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('endereco') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                                <label for="numero" class="col-md-12 control-label">Número</label>
                                <div class="col-md-12">
                                    <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}" required>

                                    @if ($errors->has('numero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('numero') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                <label for="cidade" class="col-md-12 control-label">Cidade</label>
                                <div class="col-md-12">
                                    <input id="cidade" type="text" class="form-control" name="cidade" value="{{ old('cidade') }}" required>

                                    @if ($errors->has('cidade'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cidade') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                <label for="bairro" class="col-md-12 control-label">Bairro</label>
                                <div class="col-md-12">
                                    <input id="bairro" type="text" class="form-control" name="bairro" value="{{ old('bairro') }}" required>

                                    @if ($errors->has('bairro'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bairro') }}</strong>
                                    </span>
                                    @endif
                                    <br />
                                </div>
                            </div>
                            <div class="htc__login__btn">
                                <button id="btnPageLogin" type="submit">Cadastrar</button>
                            </div>
                        </form>

                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<script>
    $("#telefone").mask("(99) 99999-9999");
    $("#cep").mask("99999-999");
    $("#cpf").mask("999.999.999-99");

    function getCEP(obj) {
        var cep = $(obj).val();
        $.ajax({
            type: 'GET',
            url: 'https://viacep.com.br/ws/' + cep + '/json/',
            success: function(data) {
                var endereco = data.logradouro;
                var bairro = data.bairro;
                var cidade = data.localidade;

                $("input#endereco").val(endereco);
                $("input#cidade").val(cidade);
                $("input#bairro").val(bairro);
            }
        });
    }
</script>
@endsection