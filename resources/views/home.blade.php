@extends('layouts.app')
<style>
        /* .modal-content {
            min-width: 600px;
            margin: 1.75rem auto;
        } */
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert" style="margin-bottom: 16px">
                    <p class="text-danger">{{ $error }}</p>
                </div>
                
            @endforeach --}}

            @if(session()->has('message'))
                <div class="alert alert-success" role="alert" style="margin-bottom: 16px">
                    {{ session()->get('message') }}
                </div>
            @endif

            {{-- @if(session()->has('message'))
                <script>
                    $(function() {
                        $('#success-modal').modal('show');
                    });
                </script>
            @endif --}}

            <div class="card">

                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    <?php $i=1 ?>
                  
                    <form id="create" action="{{action('HomeController@store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (!isset($absens[0]->description) || $absens[0]->description == 'pulang' )
                            <input class="form-control" type="text" name="description" value="masuk" readonly hidden>
                        @elseif ($absens[0]->description == 'masuk')
                            <input class="form-control" type="text" name="description" value="pulang" readonly hidden>
                        @endif
                    </form>
                    
                    @if (!isset($absens[0]->description) || $absens[0]->description == 'pulang')
                    {{-- @if ($i == 1) --}}
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-success btn-lg" style="display: block" onclick="btnCreate()">Masuk</button>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-danger btn-lg" style="display: none" onclick="btnCreate()">Pulang</button>
                        </div>
                    @elseif ($absens[0]->description == 'masuk')
                    {{-- @elseif ($i == 0) --}}
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-success btn-lg" style="display: none" onclick="btnCreate()">Masuk</button>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-danger btn-lg" style="display: block" onclick="btnCreate()">Pulang</button>
                        </div>
                    @endif
                    {{-- <div class="row justify-content-center">
                        <button type="button" class="btn btn-success btn-lg" style="display: {{ $i == 1 ? 'none' : 'block' }}" onclick="btnCreate()">Masuk</button>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-danger btn-lg" style="display:  {{ $i == 0 ? 'none' : 'block' }}" onclick="btnCreate()">Keluar</button>
                    </div> --}}

                    <div class="row justify-content-center" style="margin-top: 16px">
                        <a href="#" data-toggle="modal" data-target="#update-modal-{{ $user['id'] }}">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Update Modal --}}
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
                <form id="update-{{ $user['id'] }}" action="{{route('change.password', $user['id'])}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="password" class="col-md-5 col-form-label text-md-left">Current Password</label>

                        <div class="input-group col-md-7" id="show_hide_password">
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text" style="max-width: 44px">
                                    <a class="fa fa-eye" onclick="myFunction1()" aria-hidden="true"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label for="password" class="col-md-5 col-form-label text-md-left">New Password</label>

                        <div class="input-group col-md-7" id="show_hide_new_password">
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text" style="max-width: 44px">
                                    <a class="fa fa-eye" onclick="myFunction2()" aria-hidden="true"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-5 col-form-label text-md-left">New Confirm Password</label>

                        <div class="input-group col-md-7" id="show_hide_new_confirm_password">
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text" style="max-width: 44px">
                                    <a class="fa fa-eye" onclick="myFunction3()" aria-hidden="true"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="btnUpdate({{ $user['id'] }})">Save changes</button>
            </div>
        </div>
        </div>
    </div>

    {{-- Error Modal --}}
    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="error-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="error-modalLabel">Error Message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert" style="margin-bottom: 16px">
                        <p class="text-danger">{{ $error }}</p>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

    {{-- Success Modal --}}
    <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="success-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="success-modalLabel">Success Message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" role="alert" style="margin-bottom: 16px">
                    {{ session()->get('message') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        function btnCreate(){
            console.log("YEAH");
            document.getElementById('create').submit();
        }

        function btnUpdate(id){
            console.log("YEAH");
            document.getElementById('update-'+ id).submit();
        }

        @if (count($errors) > 0)
            $('#error-modal').modal('show');
        @endif

        @if(session()->has('message'))
            $('#success-modal').modal('show');
        @endif

        function myFunction1() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                $('#show_hide_password a').addClass( "fa-eye-slash" );
                $('#show_hide_password a').removeClass( "fa-eye" );
            } else {
                x.type = "password";
                $('#show_hide_password a').addClass( "fa-eye" );
                $('#show_hide_password a').removeClass( "fa-eye-slash" );
            }
        }

        function myFunction2() {
            var x = document.getElementById("new_password");
            if (x.type === "password") {
                x.type = "text";
                $('#show_hide_new_password a').addClass( "fa-eye-slash" );
                $('#show_hide_new_password a').removeClass( "fa-eye" );
            } else {
                x.type = "password";
                $('#show_hide_new_password a').addClass( "fa-eye" );
                $('#show_hide_new_password a').removeClass( "fa-eye-slash" );
            }
        }

        function myFunction3() {
            var x = document.getElementById("new_confirm_password");
            if (x.type === "password") {
                x.type = "text";
                $('#show_hide_new_confirm_password a').addClass( "fa-eye-slash" );
                $('#show_hide_new_confirm_password a').removeClass( "fa-eye" );
            } else {
                x.type = "password";
                $('#show_hide_new_confirm_password a').addClass( "fa-eye" );
                $('#show_hide_new_confirm_password a').removeClass( "fa-eye-slash" );
            }
        }

    </script>
@endsection
