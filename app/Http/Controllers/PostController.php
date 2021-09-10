<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;  /*importar model*/
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

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {  //veificação de arquivo corrompido
            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension(); //customizar nome da imagem no banco

            $file = $request->image->storeAs('public/posts',$nameFile);
            $file = str_replace('public/','',$file);
            $data['image'] = $file; //passar data na posição image para receber variável $image
        }

        Post::create( $data /*criar post do db e mostrar na index*/);

        return redirect()/*aqui pode usar a rota direto com a url, mas optar por nome >>*/
            ->route('posts.index')
            ->with('message', 'Publicação criada.'); //session flash funciona como popups, somente uma vez no refresh
    }

    public function show($id)
    {
        //$post = Post::where('id', $id)->first();
        //find já pega registro pelo id
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route('posts.index');
        }
        return view('admin.posts.show', ['post' => $post]);
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post)
            return redirect()->route('posts.index');

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Publicação removida.'); //session flash funciona como popups, somente uma vez
    }

    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();   //->route('posts.index');
        }
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(StoreUpdatePost $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back();   //->route('posts.index');
        }
        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('message', 'Publicação editada.'); //session flash funciona como popups, somente uma vez
    }
    public function search(Request $request)
    {
        $filters = $request->except('_token');  //array com todos os filtros utilizados menos o token

        //filtrar
        $posts = Post::where('title'/*nome do elemento*/, 'LIKE'/*'='*//*correspondência de name*/, "%{$request->search}%" /*inicio ou final do name*/)
            ->orWhere('content'/*nome do elemento*/, 'LIKE'/*correspondência de name*/, "%{$request->search}%" /*inicio ou final do name*/)
            ->paginate();
        return view('.welcome', ['posts' => $posts, 'filters' => $filters ]);
    }

    public function welcome()
    {
        $posts /*variavel aux*/ = Post::orderBy('id', 'DESC'/*decrescente*/)->paginate(); //paginação ordenada com id


        return view('.welcome', ['posts' => $posts]);
    }

    // public function datas(Request $request){
    //     $posts = new Post;
    //     $posts->date = $request->date;
    // }
}
