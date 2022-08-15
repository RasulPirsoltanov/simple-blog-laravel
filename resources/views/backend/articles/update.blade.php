@extends('backend.layouts.master')
@section('title')
    {{ $article->title }} => meqalesini redakte et
@endsection
@section('content')

    <div class="card mb-4">
    </div>
    <div class="card mb-4">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Emeliyyat uguala icra edildi.
                </div>
            @endif


            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <strong>{{ $error }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('meqaleler.update',$article->id) }}"enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="">Meqale basligi:</label>
                    <br>
                    <input type="text" value=" {{ $article->title }} " name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">kategoriasi:</label>
                    <select name="category" class="form-control" required>
                        <option selected><b> secim edin:</b></option>
                        @foreach ($categories as $category)
                            <option @if ($article->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Meqale sekli:</label>
                    <br>
                    <img src="{{ asset($article->image) }}" class="rounded" height="300px" alt="">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Kontent:</label>
                    <textarea id="editor" name="content" class="form-control" rows="10"> {!! $article->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Gonder</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                'height': 300
            });
        });
    </script>
@endsection
