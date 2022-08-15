@extends('frontend.layouts.master')
@section('title')
 {{ $articles->title }}
@endsection
    
    @section('bg',$articles->image)
@section('content')

<div class="row gx-4 gx-lg-5 justify-content-center">
    <div class="col-md-9 col-xl-7 mx-auto">
        <p>{!! $articles->content !!}</p>
        <b class="text-info">Baxis sayi=> {{$articles->hit}}</b>
        <hr>
        Placeholder text by
        <a href="http://spaceipsum.com/">Space Ipsum</a>
        &middot; Images by
        <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
        </p>
    </div>
   @include('frontend.widgets.categorywidget')
</div>
@endsection
