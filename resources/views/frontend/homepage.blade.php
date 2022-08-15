@extends('frontend.layouts.master')
@section('title')
    Ana Sehife
@endsection
@section('content')
    <div class="col-md-9 col-xl-7">
        @include('frontend.widgets.articlelist')
    </div>
    @include('frontend.widgets.categorywidget')
@endsection
