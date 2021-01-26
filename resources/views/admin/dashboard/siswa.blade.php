@extends('layouts.adminlte')

@section('title', 'Siswa')

@section('css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}
@endsection

@section('name', 'List Siswa')

@section('content')
    <div class="container">
        <div class="main-body">

            <form action="{{ action('SiswaController@index') }}">
                <div class="input-group mb-3">        
                    <input type="text" class="form-control" placeholder="Search" aria-span="Search" aria-describedby="basic-addon1" name="search_filter" id="search" value="{{ Request::get('search_filter') }}">
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
                                    <span>Email</span>
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Kelas</span>            
                                </th>
                                <th class="text-center" scope="col">
                                    <span>NISN</span>            
                                </th>
                                <th class="text-center" scope="col">
                                    <span>Action</span> 
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=1 ?>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    <span>{{$i++}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$user['name']}}">{{$user['name']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$user['email']}}">{{$user['email']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$user['description']}}">{{$user['description']}}</span>
                                </td>
                                <td class="text-center">
                                    <span name="id-{{$user['nomer_induk']}}">{{$user['nomer_induk']}}</span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update-modal-{{ $user['id'] }}">Update</button>
                                    <button type="button" data-toggle="modal" data-target="#delete-modal-{{ $user['id'] }}" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5">
                {{ $users->appends(request()->except('page'))->links() }}
            </div>
            <div class="mt-5">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">Create</button>
            </div>
        </div>

        {{-- Create Modal --}}
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="create" action="{{action('SiswaController@store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <tr>
                                <td>
                                    <span>Nama</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Kelas</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="description">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>NISN</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="nomer_induk">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Email</span>
                                </td>
                                <td>
                                    <input class="form-control" type="email" name="email">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Password</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="password" value="qwertyasd" readonly>
                                </td>
                            </tr>
                        </table>        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="btnCreate()">Save changes</button>
                </div>
            </div>
            </div>
        </div>

        {{-- Update Modal --}}
        @foreach ($users as $user)
        <div class="modal fade" id="update-modal-{{ $user['id'] }}" tabindex="-1" role="dialog" aria-labelledby="update-modal-{{ $user['id'] }}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="update-modal-{{ $user['id'] }}Label">Update {{ $user['name'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="update-{{ $user['id'] }}" action="{{action('SiswaController@update', $user['id'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table">
                            <tr>
                                <td>
                                    <span>Nama</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="name" value="{{$user['name']}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Kelas</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="description" value="{{$user['description']}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>NISN</span>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="nomer_induk" value="{{$user['nomer_induk']}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Email</span>
                                </td>
                                <td>
                                    <input class="form-control" type="email" name="email" value="{{$user['email']}}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span>Password</span>
                                </td>
                                <td>
                                    <input id="password-{{$user['id']}}" class="form-control" type="text" name="password" value="{{$user['password']}}">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="resetPassword({{ $user['id'] }})">Reset Password</button>
                                </td>
                            </tr>
                        </table>        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="btnUpdate({{ $user['id'] }})">Save changes</button>
                </div>
            </div>
            </div>
        </div>
        
        {{-- Delete Modal --}}
        <div class="modal fade" id="delete-modal-{{$user['id']}}" tabindex="-1" role="dialog" aria-labelledby="delete-modal-{{$user['id']}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="delete-modal-{{$user['id']}}Label">Delete {{ $user['name'] }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda ingin menghapus {{ $user['name'] }}?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{action('SiswaController@destroy', $user['id'])}}" method="GET" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach
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

        function btnCreate(){
            console.log("YEAH");
            document.getElementById('create').submit();
        }

        function btnUpdate(id){
            console.log("YEAH");
            document.getElementById('update-'+ id).submit();
        }

        function resetPassword(id){
            document.getElementById('password-'+ id).value = "qwertyasd";
        }
    </script>
@endsection