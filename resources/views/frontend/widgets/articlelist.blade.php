@foreach ($articles as $article)
<!-- Post preview-->
<div class="post-preview">
    <a href="{{ route('single', [Str::slug($article->getCategory->name), $article->slug]) }}">
        <h2 class="post-title">{{ $article->title }}</h2>
        <img src="https://neilpatel.com/wp-content/uploads/2017/08/blog.jpg" height="200" alt="">
        <h3 class="post-subtitle text-info">
            <p>{!! Str::limit($article->content, 60, '...') !!}</p>
        </h3>
    </a>
    <p class="post-meta d-flex justify-content-between align-items-center">

        <a href="#!"><i>Kategoriya </i> <b> {{ $article->getCategory->name }}</b></a>
        <span class="float-right">{{ $article->created_at->diffForHumans() }}</span>
    </p>
</div>
@if (!$loop->last)
    <!-- Divider-->
    <hr class="my-4" />
@endif

<!-- Post preview-->
@endforeach

<!-- Divider-->
<hr class="my-4" />
<!-- Post preview-->

<div class="d-flex flex-row"> {{ $articles->links() }}</div>