@extends('index')

@section('content')
<h2>Criar Novo Usuário</h2>
<a href="{{route('users.index')}}">< Listar Usuários</a>
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
<form action="{{route('users.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="inputName" class="form-label">Nome:</label>
        <input id="inputName" type="text" name="name" class="form-control" value="{{ fake()->unique()->name() }}">
    </div>
    <div class="mb-3">
        <label for="inputEmail" class="form-label">E-mail:</label>
        <input id="inputEmail" type="email" name="email" class="form-control"  aria-describedby="emailHelp" value="{{ fake()->unique()->email() }}">
        <div id="emailHelp" class="form-text">Seu e-mail nunca vai ser compartilhado.</div>
    </div>
    <div class="mb-3">
        <label for="inputCpf" class="form-label">CPF:</label>
        <input id="inputCpf" type="text" name="cpf" class="form-control" value="{{ fake()->unique()->cpf(false) }}">
    </div>
    <div class="mb-3">
        <label for="inputPassword" class="form-label">Password</label>
        <input id="inputPassword" type="password" name="password" class="form-control" value="123">
    </div>
    <button type="submit" class="btn btn-primary">Criar Usuário</button>
</form>
@endsection
