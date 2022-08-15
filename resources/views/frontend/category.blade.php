@extends('frontend.layouts.master')
@section('title')
    {{ $categories->name }} kategoriyasinda {{ count($articles) }} eded meqale tapildi
@endsection
@section('content')
    @if (count($articles) > 0)
        <div class="col-md-9 col-xl-7">
            @include('frontend.widgets.articlelist')
        </div>
        @include('frontend.widgets.categorywidget2')
    @else
        <div class="col-md-9 alert alert-danger text-center">
            <h1>Bu kategoriya uzre meqale yoxdur!</h1>
        </div>
        @include('frontend.widgets.categorywidget2')
    @endif
@endsection
