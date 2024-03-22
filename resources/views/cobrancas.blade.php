@extends('index')

@section('extra_links')
    <li class="nav-item">
        <a class="nav-link" href="{{route('cobrancas.create',['user' => $user->id])}}">Criar Cobrança</a>
    </li>
@endsection

@section('content')
<h2>Cobranças</h2>
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
    <a href="{{route('users.show',['user' => $user->id])}}">< Dados do usuário</a><br>
    <a href="{{route('cobrancas.create',['user' => $user->id])}}"><button class="btn btn-success">Criar nova cobrança</button></a>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Id Asaas</th>
        <th scope="col">Tipo de Pagamento</th>
        <th scope="col">Valor</th>
        <th scope="col">Data de Vencimento</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cobrancas as $cobranca)
        <tr onclick="window.location='{{route('cobrancas.show',['user' => $user->id, 'cobranca' => $cobranca->id])}}';"
            style="cursor: pointer;">
            <th scope="row">{{ $cobranca->id }}</th>
            <td>{{ $cobranca->id_asaas }}</td>
            <td>{{ $cobranca->billing_type }}</td>
            <td>{{ $cobranca->value/100 }}</td>
            <td>{{ $cobranca->due_date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
