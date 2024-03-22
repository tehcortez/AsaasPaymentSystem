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
    <h2>Cobrança</h2>
    <a href="{{route('cobrancas.index',['user' => $user->id])}}">< lista de cobranças do usuário</a>
    @if(session()->has('message'))
        <div class="alert alert-primary" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table table-striped table-hover">
        <tr>
            <th scope="row">Id:</th>
            <td>{{ $cobranca->id }}</td>
        </tr>
        <tr>
            <th scope="row">Id Asaas:</th>
            <td>{{ $cobranca->id_asaas }}</td>
        </tr>
        <tr>
            <th scope="row">Tipo:</th>
            <td>{{ $cobranca->billing_type }}</td>
        </tr>
        <tr>
            <th scope="row">Valor:</th>
            <td>{{ $cobranca->value/100 }}</td>
        </tr>
        <tr>
            <th scope="row">Data de vencimento:</th>
            <td>{{ $cobranca->due_date }}</td>
        </tr>
        @if($cobranca->billing_type === 'BOLETO')
            <tr>
                <th scope="row">Boleto URL</th>
                <td><a href="{{ $cobranca->boleto_bank_slip_url }}">{{ $cobranca->boleto_bank_slip_url }}</td>
            </tr>
        @endif
        @if($cobranca->billing_type === 'PIX')
            <tr>
                <th scope="row">QR Code Payload</th>
                <td>{{ $cobranca->pix_payload }}</td>
            </tr>
            <tr>
                <th scope="row">QRCode</th>
                <td><img src="data:image/png;base64, {{ $cobranca->pix_encoded_image }}" alt="QrCode"></td>
            </tr>
        @endif
    </table>
@endsection
