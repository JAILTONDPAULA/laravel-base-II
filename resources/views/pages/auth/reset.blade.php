@extends('layout.main')
@section('title', 'Reset de Senha')
@section('head')
@vite(['resources/js/page/auth/reset.js'])
@endsection
@section('content')
<section class="containerpage">
    <div class="circle-white"></div>
    <div class="circle-white segundo"></div>
    <div class="image">
        <img src="/image/logo-traum-fabrik.png" alt="Logo TraumFabrik" width="200">
    </div>
    {{-- Request Token --}}
    <form id="loginForm">
        <section class="head-form">
            <h1>Solicitar Reset de Senha</h1>
            <p>Por favor, informe o e-mail associado à sua conta para receber o link de redefinição de senha.</p>
        </section>
        <section class="info-data">
            <div class="group-input">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" value="{{ request('email') ?? '' }}" required>
            </div>
            <button type="submit">Solicitar Reset</button>
        </section>
        <section class="footer">
            <a href="{{ route('login') }}">Voltar para o login</a>
            <small>TraumFabrik &copy; {{ date('Y') }}</small>
        </section>
    </form>
    {{-- Confirme Token --}}
    <form id="confirmTokenForm">
        <section class="head-form">
            <h1>Redefinir Senha</h1>
            <p>Confirme o token enviado para o seu e-mail para realizar a redefinição de senha.</p>
        </section>
        <section class="info-data">
            <div class="codescheck">
                <input type="tel" name="number[]" id="number-one"   size="1" maxlength="1" required>
                <input type="tel" name="number[]" id="number-two"   size="1" maxlength="1" required>
                <input type="tel" name="number[]" id="number-three" size="1" maxlength="1" required>
                <input type="tel" name="number[]" id="number-four"  size="1" maxlength="1" required>
                <input type="tel" name="number[]" id="number-five"  size="1" maxlength="1" required>
                <input type="tel" name="number[]" id="number-six"   size="1" maxlength="1" required>
            </div>
            <div class="novasenha">
                <div class="group-input password">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" placeholder="Digite sua senha" required>
                    <div>🙈</div>
                </div>
                <div class="checklist">
                    <p>Requisitos da senha:</p>
                    <ul>
                        <li id="length"    class="invalid">Mínimo de 8 caracteres</li>
                        <li id="uppercase" class="invalid">Pelo menos uma letra maiúscula</li>
                        <li id="lowercase" class="invalid">Pelo menos uma letra minúscula</li>
                        <li id="number"    class="invalid">Pelo menos um número</li>
                        <li id="special"   class="invalid">Pelo menos um caractere especial</li>
                    </ul>
                </div>
                <button type="submit" id="btn-reset-password" disabled>Redefinir Senha</button>
            </div>
        </section>
        <section class="footer">
            <button type="button" id="btn-new-token">Solicitar Novo Token</button>
            <a href="{{ route('login') }}">Voltar para o login</a>
            <small>TraumFabrik &copy; {{ date('Y') }}</small>
        </section>
    </form>
</section>
@endsection
