@extends('frontend.layouts.master')
@section('title', 'Kontakt sehifesi')

@section('bg', 'assets/img/contact-bg.jpg')
@section('content')
    <div class="col-md-10 col-lg-8 col-xl-7">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Mesajiniz qeyd edildi.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
        <p>Bizimle Elaqe saxlaya bilersiz</p>
        <div class="my-5">
            <form id="contactForm" method="POST" action="{{ route('contactPost') }}">
                @csrf
                <div class="control-group">
                    <label for="name">Ad Soyad</label>
                    <input class="form-control" id="name" value="{{ old('name') }}" name="name" type="text"
                        placeholder="Enter your name..." />
                </div>
                <div class="control-group">
                    <label for="email">Email addresi</label>
                    <input class="form-control" id="email" value="{{ old('email') }}" name="email" type="email"
                        placeholder="Enter your email..." />
                </div>
                <div class="control-group">
                    <label for="">Movzu</label>
                    <select class="form-select" name="topic" id="phone">
                        <option selected>
                            <h1>Movzu</h1>
                        </option>
                        <option @if (old('topic') == 'Bilgi') selected @endif>Bilgi</option>
                        <option @if (old('topic') == 'Destek') selected @endif>Destek</option>
                        <option @if (old('topic') == 'Umumi') selected @endif>Umumi</option>
                    </select>
                </div>
                <div class="control-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" id="message" placeholder="Enter your message here..."
                        style="height: 12rem" data-sb-validations="required">{{ old('message') }}</textarea>
                </div>
                <button class="btn btn-primary text-uppercase " id="submitButton" type="submit">Send</button>
            </form>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                    content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>

@endsection
