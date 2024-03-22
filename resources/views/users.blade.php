@extends('index')

@section('content')
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<h2>Usuários</h2>
    <a href="{{route('users.create')}}">Criar novo usuário</a>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">CPF</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr onclick="window.location='{{route('users.show',['user' => $user->id])}}';" style="cursor: pointer;">
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->cpf }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
