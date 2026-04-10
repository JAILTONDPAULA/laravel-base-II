@extends('layout.main')
@section('title', 'Login')
@section('head')
@vite(['resources/js/page/auth/login.js'])
@endsection
@section('content')
<section class="containerpage">
    <div class="circle-white"></div>
    <div class="circle-white segundo"></div>
    <div class="image">
        <img src="/image/logo-traum-fabrik.png" alt="Logo TraumFabrik" width="200">
    </div>
    <form id="loginForm">
        <section class="head-form">
            <h1>{{ config('app.name') }}</h1>
            <h2>ConectaBR</h2>
        </section>
        <section class="info-data">
            <div class="group-input">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="group-input password">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Digite sua senha" required>
                <div>🙈</div>
            </div>
            <button type="submit">Entrar</button>
        </section>
        <section class="footer">
            <a href="{{ route('reset') }}">Esqueci minha senha</a>
            <small>TraumFabrik &copy; {{ date('Y') }}</small>
        </section>
    </form>
</section>
@endsection
