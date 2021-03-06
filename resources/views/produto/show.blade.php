@extends('layouts.app')
@section('title', $produto->titulo?$produto->titulo:'')
@section('content')
    <h1>Produto {{ $produto->titulo?$produto->titulo:'' }}</h1>
    <div class="row">

        <div class="col-md-6 col-md-3">
            <ul>
                <li>Referência: {{ $produto->referencia }}</li>
                <li>Preço: R$ {{ number_format($produto->preco, 2, ',', '.') }}</li>
                <li>Adicionado em: {{ date('d/m/Y', strtotime($produto->created_at)) }}</li>
            </ul>
            <p>{{ $produto->descricao }}</p>
        </div>
        @if (file_exists('./img/produtos/' . md5($produto->id) . '.jpg'))
            <div class="col-md-6 col-md-3">
                <a href="{{ asset('img/produtos/'. md5($produto->id) . '.jpg') }}" class="thumbnail">
                    {{ Html::image(asset('img/produtos/' . md5($produto->id).".jpgo")) }}
                </a>
            </div>
        @endif
    </div>
    <a href="javascript:history.go(-1)">« Voltar</a>
@endsection
