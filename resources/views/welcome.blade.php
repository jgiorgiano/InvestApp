@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 px-0">
            <div class="fh">
                <img class="img-fluid" src="{{ asset('images/rawpixel-790897-unsplash.jpg')}}" alt="">
            </div>
        </div>
        <div id="login" class="col-md-4 bg-success py-4"> 
            <div class="fh">   
            <h1>Investindo</h1>
            <h6>O nosso Gerenciador de Investimentos</h6>            
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class>Acesse o sistema</h3>
                        <div class="form-group">
                                <input id="email" type="email" placeholder="Usuario" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                            
                        </div>

                        <div class="form-group"> 
                                <input id="password" type="password" placeholder="Senha" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                           
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Entrar') }}
                                </button>

                                <a class="btn text-white" href="{{ route('password.request') }}">
                                    {{ __('Esqueceu sua senha?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection
