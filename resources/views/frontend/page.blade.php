@extends('frontend.layouts.master')
@section('title')
    {{ $page->title }}
@endsection
@section('bg', $page->image)
@section('content')
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="page-heading">
                    <h1>Melumat sehifesi</h1>
                    <span class="subheading">Bu menim ne edeceyimdir.</span>
                </div>
            </div>
        </div>
    </div>
    </header>
    <!-- Main Content-->
    <main class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </main>
@endsection
