<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Session;


class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(4);
        return view('produto.index', array('produtos' => $produtos, 'busca' => null));
    }

    public function show($id)
    {
        $produto = Produto::find($id);
        //echo '<pre>';
        //print_r($produto);
        //echo '</pre>';
        return view('produto.show', array('produto' => $produto));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('produto.create');
        } else {
            return redirect('login');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'referencia' => 'required|unique:produtos|min:3',
            'titulo' => 'required|min:3'
        ]);

        $produto = new Produto();

        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');

        if ($produto->save()) {
            return redirect('produtos');
        }
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto.edit', array('produto' => $produto));
    }



    public function update($id, Request $request)
    {
        $produto =  Produto::find($id);
        $this->validate($request, [
            'referencia' => 'required|min:3',
            'titulo' => 'required|min:3'
        ]);

        if ($request->hasFile('fotoproduto')) {
            $imagem = $request->file('fotoproduto');
            $nomearquivo = md5($id) . '.' . $imagem->getClientOriginalExtension();
            $request->file('fotoproduto')->move(public_path('./img/produtos/'), $nomearquivo);
        }

        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');

        $produto->save();
        Session::flash('mensagem', 'Produto alterado com sucesso.');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        Session::flash('mensagem', 'Produto exclu??do com sucesso.');
        $produto = 0;
        return redirect()->back();

    }

    public function buscar(Request $request)
    {
        $produtos = Produto::where('titulo', 'LIKE', '%' .
            $request->input('busca') . '%')->orwhere('descricao', 'LIKE', '%' . $request->input('busca') . '%')->paginate(4);
        return view('produto.index', array('produtos' => $produtos, 'busca' => $request->input('busca')));
    }
}
