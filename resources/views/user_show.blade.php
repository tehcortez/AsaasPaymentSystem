@extends('index')

@section('extra_links')
    <li class="nav-item">
        <a class="nav-link" href="{{route('cobrancas.index',['user' => $user->id])}}">Listar Cobrança</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('cobrancas.create',['user' => $user->id])}}">Criar Cobrança</a>
    </li>
@endsection

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-primary" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    <h2>Exibir Usuário</h2>
    <a href="{{route('users.index')}}">< Listar Usuários</a>
    <table class="table table-striped table-hover">
        <tr>
            <td><a href="{{route('cobrancas.index',['user' => $user->id])}}"><button class="btn btn-primary">Listar cobranças</button></a></td>
            <td><a href="{{route('cobrancas.create',['user' => $user->id])}}"><button class="btn btn-success">Criar nova cobrança</button></a></td>
        </tr>
        <tr>
            <th scope="row">Id:</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th scope="row">Id Asaas:</th>
            <td>{{ $user->id_asaas }}</td>
        </tr>
        <tr>
            <th scope="row">Nome:</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th scope="row">E-mail:</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th scope="row">CPF:</th>
            <td>{{ $user->cpf }}</td>
        </tr>
        <tr>
            <td>
                <form action="{{route('users.destroy',['user'=>$user->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </td>
            <td><a href="{{route('users.edit',['user' => $user->id])}}"><button class="btn btn-primary">Editar</button></a></td>
        </tr>
    </table>
@endsection
