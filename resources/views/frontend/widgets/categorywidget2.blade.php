@isset($categories)
    <div class="list-group col-md-3">
        <div class="card">
            <div class="card-header bg-info">
                Kategorialar
            </div>
            @foreach ($categories2 as $category)
                <a href="{{ route('category', $category->slug) }}"
                    class="list-group-item d-flex justify-content-between align-items-center @if(Request::segment(2)==$category->slug) active @endif">{{ $category->name }}
                    <span class="badge bg-primary rounded-pill">{{ $category->articleCount() }}</span></a>
            @endforeach
        </div>
    </div>
    @endisset
