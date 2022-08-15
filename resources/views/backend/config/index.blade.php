@extends('backend.layouts.master')
@section('title', 'Butun Kategorialar')
@section('content')
    <div class="row">
        <div class="card shadow mb-4" style="border:green">
            <div class="card-header">
                <label for="">Yeni Kategoria:</label>
            </div>
            <div class="card-body">
                <form action="{{route('updateConfig')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sayt basligi:</label>
                                <input type="text" name="title" class="form-control" value="{{ $config->title }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Sayt Aktivliyi:</label>
                                <select name="activ" class="form-control" id="">
                                    <option @if ($config->aktiv == '1') selected @endif value="1">Aktiv</option>
                                    <option @if ($config->aktiv == '0') selected @endif value="0">Deaktiv
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset($config->logo)}}" style="width:190px" alt="">
                            <div class="form-group">
                                <label for="">Sayt Logo:</label>
                                <input type="file" name="logo" class="form-control" value="{{ $config->title }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset($config->favicon)}}" style="width:190px" alt="">
                            <div class="form-group">
                                <label for="">Sayt Favicon:</label>
                                <input type="file" name="favicon" class="form-control" value="{{ $config->title }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">linkedin link:</label>
                                <input type="text" name="linkedin" class="form-control" value="{{ $config->linkedin }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Facebook link:</label>
                                <input type="text" name="facebook" class="form-control" value="{{ $config->facebook }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Github link:</label>
                                <input type="text" name="github" class="form-control" value="{{ $config->github }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Instagram link:</label>
                                <input type="text" name="instagram" class="form-control" value="{{ $config->instagram }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Youtube link:</label>
                                <input type="text" name="youtube" class="form-control" value="{{ $config->youtube }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">twitter link:</label>
                                <input type="text" name="twitter" class="form-control" value="{{ $config->twitter }}"
                                    >
                            </div>
                        </div>
                        <div class="col-md-6 mx-auto " style="margin-top: 20px">
                            <div class="form-group">
                                <button type="submit" class="gap-3 btn w-100 btn-block btn-md  btn-success ">Yenile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
