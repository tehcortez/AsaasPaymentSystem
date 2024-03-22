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
<h2>Erros da api de cobrança Asaas</h2>
<a href="{{route('cobrancas.index',['user' => $user->id])}}">< Lista de cobranças do usuário</a>
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
@if(session()->has('errorMessages'))
    @foreach(session()->get('errorMessages') as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error->description }}
    </div>
    @endforeach
@endif
@endsection
