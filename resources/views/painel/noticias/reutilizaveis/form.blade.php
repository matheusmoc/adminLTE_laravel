<!--ckeditor-->
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/[version.number]/[distribution]/ckeditor.js"></script>


<!--Tudo que seria duplicado nas views, estará aqui e será usado com o @@include('')-->


<!--exibir erro de validação-->
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
<div class='container'>
    @csrf
    <!--contra ataques csrf com milhares de registro no db-->
    <input type="text" class="form-control mb-4" name="title" id="title" placeholder="Título"
        value="{{ $post->title ?? old('title') }}">
    <!--'old'deixa o campo preenchido ao dar erro de cadastro-->
    <textarea name="content" class="form-control mb-5" id="editor" cols="30" rows="4"
        placeholder="Conteúdo">{!! $post->content ?? old('content') !!}</textarea>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>

    <hr>
    <input type="file" name="image" id="image"><br>
    <button type="submit" class="btn btn-primary mt-5">Enviar</button>
</div>
