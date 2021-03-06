@extends('layouts.app')
@section('title', 'Listagem de produtos')

@section('content')
    <h1>Produtos</h1>
    {{ Form::open(['url' => ['produtos/buscar']]) }}
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                {{Form::text('busca', $busca, ['class'=>'form-control', 'required', 'place-holder'=>'buscar'])}}
                <span class="input-group-btn">
                    {{Form::submit('Buscar', ['class'=>'btn btn-primary'])}}
                </span>
            </div>
        </div>

    </div>
    {{Form::close()}}

    @if (Session::has('mensagem'))
        <div class="alert alert-success">
            {{ Session::get('mensagem') }}
        </div>
    @endif

    <div class="container">
    <div class="row">

        @foreach ($produtos as $produto)
            <div class='col-md-3' style="border: 1px solid #ccc">
                <h4>{{ $produto->titulo }}</h4>

                @if (file_exists('./img/produtos/' . md5($produto->id) . '.jpg'))

                    <a class='thumbnail' href=" {{ url('produtos/' . $produto->id) }}">
                        {{ Html::image(asset('img/produtos/' . md5($produto->id) . '.jpg')) }}
                    </a>
                @else
                    <a class='thumbnail' href="{{ url('produtos/' . $produto->id) }}">
                        {{ $produto->titulo }}
                    </a>
                @endif
                @if (Auth::check())
                {{ Form::open(['route' => ['produtos.destroy', $produto->id], 'method' => 'DELETE']) }}
                <a class="btn btn-info" href="{{ url('produtos/' . $produto->id . '/edit') }}">Editar</a>
                {{ Form::submit('Excluir', ['class' => 'btn btn-success']) }}
                {{ Form::close() }}
                @endif
            </div>
        @endforeach
    </div>
    </div>
    <div class="row">

    <a href="{{url('produtos/create')}}">Novo produto</a>
    </div>
    {{$produtos->links()}}
@endsection
