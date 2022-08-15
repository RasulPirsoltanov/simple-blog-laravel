@extends('backend.layouts.master')
@section('title', 'Butun Kategorialar')
@section('content')
    <div class="row">
        <div class="card  mb-4" style="border:green">
            <div class="card-header">
                <label for="">Yeni Kategoria:</label>
            </div>
            <div class="card-body">

                <form action="{{ route('createCategory') }}" method="POST" class="">
                    @csrf
                    <div class="">
                        <label for="">Yeni Kategoria adi:</label>
                        <input type="text" class="  form-control form-controller" name="name" required>
                    </div>
                    <br>
                    <div class="">
                        <button type="submit" class="btn btn-primary  float-end">Gonder</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="card bg-grey text-white mb-4">
            <div class="card-body">@yield('title')</div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Kategoria</th>
                        <th>Meqale sayi</th>
                        <th>status</th>
                        <th>elaeve edilme tarixi</th>
                        <th>Emeliyyatlar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td> {{ $category->articleCount() }}</td>
                            <td>
                                <input type="checkbox" categoryid="{{ $category->id }}" class="switch" data-on="Aktiv"
                                    data-off="Passiv" data-toggle="toggle" data-onstyle="success" data-offstyle="danger"
                                    @if ($category->status === 1) checked @endif>
                            </td>
                            <td>{{ $category->created_at->diffForhumans() }}</td>

                            <td>
                                <table>
                                    <tr>
                                        <td><a target="_blank" href="" title="goruntule" class="btn btn-success">
                                                <i class=" fa fa-eye"></i></a>
                                        </td>

                                        <td>
                                            <button category-id='{{ $category->id }}' title="Kategoriani redakte et"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                class="edit-click btn btn-info "><i class="fa fa-pen"></i></button>
                                        </td>
                                        <td><button category-id='{{ $category->id }}' category-name='{{ $category->name }}'
                                                category-count="{{ $category->articleCount() }}" title="Kategoriani sil."
                                                data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                class="delete-click btn btn-danger "><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </table>

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    {{-- <!-- Modal --> --}}


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('changeData') }}">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <label for="">Duzelis edin:</label>
                        <input type="text" name="name" id="edit-name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cix</button>
                    <button type="submit" class="btn btn-primary">Yadda Saxla</button>
                </div>
                </form>

            </div>
        </div>
    </div>


    {{-- Modal End --}}

    {{-- <!-- Modal --> --}}


    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xeberdarliq!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="alert" class="alert alert-danger">

                </div>
                <div class="modal-footer">
                    <form action="{{ route('deleteCategory') }}" method="POST">
                        @csrf
                        <input type="hidden" id="delete_id" name="delete_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cix</button>
                        <button id="deletButton" type="submit" class="btn btn-primary">Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal End --}}
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.2/css/bootstrap5-toggle.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap5-toggle@4.3.2/js/bootstrap5-toggle.min.js"></script>
    <script>
        $(function() {

            $('.delete-click').click(function() {
                id = $(this)[0].getAttribute('category-id');
                name = $(this)[0].getAttribute('category-name');
                count = $(this)[0].getAttribute('category-count');
                document.getElementById('delete_id').value = id;
                if (id == '1') {
                    $('#deletButton').hide();
                    $('#alert').html(name +
                        ' kategoriasi sabit kategoriadir ve Siline bilmez diger silinen kategorialara aid meqleler bu kategoriada toplanir. '
                        );
                }
                if (count > 0 && id != 1) {
                    $('#deletButton').show();
                    $('#alert').html('Bu kategoriada ' + count +
                        ' eded meqale var silmek istediyinzden eminsiz?');
                } else if (count == 0 && id != 1) {
                    $('#alert').html('Bu kategoriada 0 meqale var silmek istediyinzden eminsiz?');
                }
            })



            $(".edit-click").click(function() {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('getData') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        console.log(data);
                        console.log(data.name);
                        if (data) {
                            document.getElementById('edit-name').value = data.name;
                            document.getElementById('edit_id').value = data.id;
                        }
                    }
                })
            })





            $('.switch').change(function() {
                id = $(this)[0].getAttribute('categoryid');
                status = $(this).prop('checked');
                $.get('{{ route('switchcategory') }}', {
                    id: id,
                    status: status
                }, function(data, status) {
                    console.log(data);
                });
            })
        })
    </script>
@endsection
