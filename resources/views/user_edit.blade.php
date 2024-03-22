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
<h2>Edit User</h2>
<a href="{{route('users.show',['user' => $user->id])}}">< Exibir Usuários</a>
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<form action="{{route('users.update',['user'=>$user->id])}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="inputName" class="form-label">Nome:</label>
        <input id="inputName" type="text" name="name" class="form-control" value="{{$user->name}}">
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">E-mail:</label>
        <input id="inputEmail" type="email" name="email" class="form-control" value="{{$user->email}}">
    </div>
    <div class="mb-3">
        <label for="inputCpf" class="form-label">CPF:</label>
        <input id="inputCpf" type="text" name="cpf" class="form-control" value="{{$user->cpf}}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
