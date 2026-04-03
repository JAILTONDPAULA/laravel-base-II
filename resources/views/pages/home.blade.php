@extends('layout.main')
@section('titulo', 'Home')
@section('head')
@vite(['resources/js/page/home.js', 'resources/sass/pages/home.sass'])
@endsection
@section('content')
<x-header/>
Hellow word

@endsection
