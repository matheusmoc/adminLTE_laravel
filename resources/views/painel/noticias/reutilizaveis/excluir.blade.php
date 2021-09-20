<!--excluir publiucação--->


    <form action="{{ route('painel.excluir', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button class='btn btn-danger ml-1' type="submit">Excluir{{--{{ $post->title }}--}}</button>
    </form>
