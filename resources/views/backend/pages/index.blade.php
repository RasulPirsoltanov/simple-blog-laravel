@extends('backend.layouts.master')
@section('title')
    Butun Meqaleler
@endsection
@section('content')
    <div class="card mb-4">

    </div>
    <div class="card mb-4">
        <div class="card-header float-right ">
            <i class="fas fa-table me-1"></i>
            <strong>{{ $pages->count() }} meqale tapildi</strong>
            <a href="{{ route('trashed') }}" class="btn btn-warning float-end"><i class="fa fa-trash"></i>Silinen meqaleler</a>
        </div>

        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Meqale basligi</th>
                        <th>Meqale sekili</th>
                        <th>elaeve edilme tarixi</th>
                        <th>Statusu</th>
                        <th>Emeliyyatlar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td><img src="{{ asset($page->image) }}" height="50px" alt=""></td>
                            <td>{{ $page->created_at->diffForhumans() }}</td>
                            <td>
                                <input type="checkbox" data="{{ $page->id }}" class="switch" data-on="Aktiv"
                                    data-off="Passiv" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                    @if ($page->status === 1) checked @endif>
                            </td>

                            <td>
                                <table>
                                    <tr>
                                        <td><a target="_blank" href="{{ route('page', $page->slug) }}" title="goruntule"
                                                class="btn btn-success"> <i class=" fa fa-eye"></i></a>
                                        </td>

                                        <td>
                                            <a title="Redakte et" href="{{ route('editPageShow', $page->id) }}"
                                                class="btn btn-info "><i class="fa fa-pen"></i></a>
                                        </td>
                                        <td><a href="{{ route('deletePages', $page->id) }}" title="Sil"
                                                class="btn btn-danger "> <i class="fa fa-times"></i></a></td>
                                    </tr>
                                </table>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.2/css/bootstrap5-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.2/js/bootstrap5-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('data');
                status = $(this).prop('checked');
                $.get('{{ route('switcPages') }}', {
                    id: id,
                    status: status
                }, function(data, status) {
                    console.log(data);
                });
            })
        })
    </script>
@endsection
