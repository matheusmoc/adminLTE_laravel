<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        $posts /*variavel aux*/ = Post::orderBy('id', 'DESC'/*decrescente*/)->paginate(); //paginação ordenada com id

        return view('painel.noticias.index', ['posts' => $posts]);
    }

    public function novo()
    {
        return view('painel.noticias.novo');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {  //veificação de arquivo corrompido
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension(); //customizar nome da imagem no banco

            $file = $request->image->storeAs('public/painel',$nameFile);
            $file = str_replace('public/','',$file);
            $data['image'] = $file; //passar data na posição image para receber variável $image
        }

        Post::create( $data /*criar post do db e mostrar na index*/);

        return redirect()/*aqui pode usar a rota direto com a url, mas optar por nome >>*/
            ->route('painel.index')
            ->with('message', 'Publicação criada.'); //session flash funciona como popups, somente uma vez no refresh
    }

    public function show($id)
    {
        //$post = Post::where('id', $id)->first();
        //find já pega registro pelo id
        $posts = Post::find($id);
        if (!$posts) {
            return redirect()->route('painel.noticias.index');
        }
        return view('painel.noticias.visualizar', ['posts' => $posts]);
    }


    public function excluir($id)
    {
        $post = Post::find($id);
        if (!$post)
            return redirect()->route('painel.index');

        $post->delete();

        return redirect()
            ->route('painel.index')
            ->with('message', 'Publicação removida.'); //session flash funciona como popups, somente uma vez
    }

    public function editar($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();   //->route('posts.index');
        }
        return view('painel.noticias.editar', ['post' => $post]);
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();   //->route('posts.index');
        }
        $post->update($request->all());

        return redirect()->route('painel.index')
            ->with('message', 'Publicação editada.'); //session flash funciona como popups, somente uma vez
    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');  //array com todos os filtros utilizados menos o token

        //filtrar
        $posts = Post::where('title'/*nome do elemento*/, 'LIKE'/*'='*//*correspondência de name*/, "%{$request->search}%" /*inicio ou final do name*/)
            ->orWhere('content'/*nome do elemento*/, 'LIKE'/*correspondência de name*/, "%{$request->search}%" /*inicio ou final do name*/)
            ->paginate();
        return view('painel.noticias.visualizar', ['posts' => $posts, 'filters' => $filters ]);
    }

    public function painel()
    {
       $posts /*variavel aux*/ = Post::orderBy('id', 'DESC'/*decrescente*/)->paginate(); //paginação ordenada com id


        return view('painel.painel', ['posts' => $posts]);
    }

    // public function datas(Request $request){
    //     $posts = new Post;
    //     $posts->date = $request->date;
    //
}
