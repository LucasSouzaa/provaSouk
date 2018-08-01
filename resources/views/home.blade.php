@extends('adminlte::page')

@section('title', 'Listagem de usuários')



@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{URL::to('/create')}}" class="btn btn-primary"><strong><i class="fa fa-plus"></i> Novo Usuário</strong></a>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <form action="{{URL::to('/find')}}" method="POST" id="formSearch">
                @csrf
                <div class="input-group" style="padding-bottom: 15px">
                    <input class="form-control" name="search" placeholder="Busque por nome ou email ou cpf ou deixe em branco para mostrar todos">
                    <span onclick="$('#formSearch').submit();" class="btn btn-primary input-group-addon" id="basic-addon2">Buscar</span>
                </div>
            </form>
        </div>
    </div>
    <div class="box-body" style="background-color: #fff;">
        <table class="table table-hover">
            <thead>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Data de nascimento</th>
                <th>Foto</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach($users as $key => $value)
                <tr>
                    <td style="vertical-align: middle">{{$value->name}}</td>
                    <td style="vertical-align: middle">{{$value->email}}</td>
                    <td style="vertical-align: middle">{{$value->cpf}}</td>
                    <td style="vertical-align: middle">{{date('d-m-Y', strtotime($value->birthdate))}}</td>
                    <td style="vertical-align: middle"><img height="50" src="{{$value->image}}"></td>
                    <td style="vertical-align: middle; cursor: pointer;">
                        <a href="{{URL::to('/toggle/'.$value->id)}}"><i class="fa {{$value->status ? 'text-green fa-check' : 'text-red fa-times'}}"></i></a>
                        <a href="{{URL::to('/edit/'.$value->id)}}"><i class="fa fa-edit text-blue"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@stop

