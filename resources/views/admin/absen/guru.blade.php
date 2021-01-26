@extends('layouts.adminlte')

@section('title', 'Guru')

@section('css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}
@endsection

@section('name', 'Absen Guru')

@section('content')
    <div class="container">
        <div class="main-body">

            <form action="{{ action('AbsenGuruController@index') }}">
                <div class="input-group mb-3">        
                    <input type="text" class="form-control col-11" placeholder="Search" aria-span="Search" aria-describedby="basic-addon1" name="search_filter" id="search" value="{{ Request::get('search_filter') }}">
                    <select class="custom-select col-1" name="search_tanggal" id="search">
                        <option value="">Semua Hari</option>
                        <option value="{{date("Y-m-d")}}">Hari Ini</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">
                                    <span>No</span>
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Nama</span>
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Mata Pelajaran</span>            
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Tanggal</span>            
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Waktu</span>            
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Deskripsi</span>            
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach ($absens as $absen)
                            <tr>
                                <td class="text-center">
                                    <span>{{$i++}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$absen['name']}}">{{$absen['name']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$absen['users_description']}}">{{$absen['users_description']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$absen['tanggal']}}">{{$absen['tanggal']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$absen['waktu']}}">{{$absen['waktu']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$absen['description']}}">{{$absen['description']}}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="my-5">
                {{ $absens->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        // function openCreateModal() {
        //     var createModal = document.getElementById('create-modal');
        //     createModal.style.display = 'block';
        // }

        // function closeCreateModal() {
        //     var createModal = document.getElementById('create-modal');
        //     createModal.style.display = 'none';
        // }

        // function openUpdateModal(id) {
        //     var updateModal = document.getElementById('update-modal-' + id);
        //     updateModal.style.display = 'block';
        // }

        // function closeUpdateModal(id) {
        //     var updateModal = document.getElementById('update-modal-' + id);
        //     updateModal.style.display = 'none';
        // }

        // function openDelModal(id) {
        //     var delModal = document.getElementById('delete-modal-' + id);
        //     delModal.style.display = 'block';
        // }

        // function closeDelModal(id) {
        //     var deleModal = document.getElementById('delete-modal-' + id);
        //     deleModal.style.display = 'none';
        // }

        // function btnCreate(){
        //     console.log("YEAH");
        //     document.getElementById('create').submit();
        // }

        // function btnUpdate(id){
        //     console.log("YEAH");
        //     document.getElementById('update-'+ id).submit();
        // }

        // function resetPassword(id){
        //     document.getElementById('password-'+ id).value = "qwertyasd";
        // }
    </script>
@endsection