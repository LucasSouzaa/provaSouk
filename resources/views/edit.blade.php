@extends('adminlte::page')

@section('title', 'Listagem de usuários')

<meta name="csrf-token" content="{{ Session::token() }}">

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')


    <div class="box-body" style="background-color: #fff;">

        <div class="col-md-offset-4 col-md-4">
            @include('notifications')
        </div>
        <div class="row">

            <div class="col-md-6">
                <form action="{{URL::to('/update/'.$user->id)}}" method="POST" id="userForm">
                    @csrf
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" name="name" placeholder="Nome do usuário" required="" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{$user->email}}" class="form-control" type="email" name="email" placeholder="Email para acesso ao sistema" required>
                    </div>
                    <div class="form-group">
                        <label>Data de nascimento</label>
                        <input value="{{$user->birthdate}}" class="form-control" type="date" name="birthdate" required="">
                    </div>
                    <div class="form-group" id="groupCpf">
                        <label>CPF</label>
                        <input value="{{$user->cpf}}" class="form-control" type="text" name="cpf" required="">
                    </div>

                    <div class="form-group" id="groupPassword">
                        <label>Senha</label>
                        <input class="form-control" type="password" name="password" required="">
                    </div>

                    <div class="form-group" id="groupReTypePassword">
                        <label>Confirme a senha</label>
                        <input class="form-control" type="password" name="retypepassword" required="">
                    </div>

                    <input type="text" hidden="" name="image">

                    <button class="btn btn-primary"><strong><i class="fa fa-plus"></i> Salvar</strong></button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Imagem</label>
                    <input class="form-control" type="file" accept="image/*" name="imageUploader" required="">
                </div>
                <div>
                    <img name="imgUploaded" height="100" width="100" src="{{$user->image}}" />
                </div>
            </div>

        </div>
    </div>



@stop

@section('js')
    <script type="text/javascript" src="{{ mix('js/user.js') }}"></script>
@stop

