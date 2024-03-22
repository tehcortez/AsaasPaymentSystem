@extends('index')

@section('extra_links')
    <li class="nav-item">
        <a class="nav-link" href="{{route('cobrancas.index',['user' => $user->id])}}">Listar Cobrança</a>
    </li>
@endsection

@section('content')
<h2>Criar nova cobrança</h2>
<a href="{{route('cobrancas.index',['user' => $user->id])}}">< Lista de cobranças do usuário</a>
@if(session()->has('message'))
    <div class="alert alert-primary" role="alert">
        {{ session()->get('message') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('cobrancas.store',['user' => $user->id])}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="billingType" class="form-label">Tipo:</label>
        <select class="form-select" name="billing_type" id="billingType" onchange="checkBillingType()">
            <option value="BOLETO">Boleto</option>
            <option value="PIX">Pix</option>
            <option value="CREDIT_CARD">Cartão de Credito</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="inputValue" class="form-label">Valor:</label>
        <input id="inputValue" type="number" name="value" step="0.01" min="0.01" max="9999.99" class="form-control" value="{{ fake()->randomFloat(2,0.01,9999.99) }}">
    </div>
    <div class="mb-3">
        <label for="inputDueDate" class="form-label">Data de vencimento:</label>
        <input id="inputDueDate" type="date" name="due_date" class="form-control" value="{{ fake()->dateTimeBetween('+0 days', '+30 days')->format('Y-m-d')}}">
    </div>
    <div id="creditCardData">
        <h4>Informações do cartão de crédito</h4>
        <div class="mb-3">
            <label for="inputHolderName" class="form-label">Nome impresso no cartão:</label>
            <input id="inputHolderName" type="text" name="holderName" class="form-control" value="{{ fake()->name() }}">
        </div>
        <div class="mb-3">
            <label for="inputCCNumber" class="form-label">Número do cartão:</label>
            <input id="inputCCNumber" type="text" name="number" class="form-control" value="{{ fake()->creditCardNumber() }}">
        </div>
        <div class="mb-3">
            <label for="inputExpiryMonth" class="form-label">Mês de expiração (ex: 06):</label>
            <input id="inputExpiryMonth" type="text" name="expiryMonth" class="form-control" value="{{ fake()->creditCardExpirationDateString(true,'m') }}">
        </div>
        <div class="mb-3">
            <label for="inputExpiryYear" class="form-label">Ano de expiração com 4 dígitos (ex: 2019):</label>
            <input id="inputExpiryYear" type="text" name="expiryYear" class="form-control" value="{{ fake()->creditCardExpirationDateString(true,'Y') }}">
        </div>
        <div class="mb-3">
            <label for="inputCcv" class="form-label">Código de segurança:</label>
            <input id="inputCcv" type="text" name="ccv" class="form-control" value="{{ fake()->randomNumber(3,true) }}">
        </div>
        <h4>Informações do titular do cartão de crédito</h4>
        <div class="mb-3">
            <label for="inputName" class="form-label">Nome do titular do cartão:</label>
            <input id="inputName" type="text" name="name" class="form-control" value="{{ fake()->name() }}">
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email do titular do cartão:</label>
            <input id="inputEmail" type="text" name="email" class="form-control" value="{{ fake()->email() }}">
        </div>
        <div class="mb-3">
            <label for="inputCpfCnpj" class="form-label">CPF ou CNPJ do titular do cartão:</label>
            <input id="inputCpfCnpj" type="text" name="cpfCnpj" class="form-control" value="{{ fake()->cpf() }}">
        </div>
        <div class="mb-3">
            <label for="inputPostalCode" class="form-label">CEP do titular do cartão:</label>
            <input id="inputPostalCode" type="text" name="postalCode" class="form-control" value="01001000">
        </div>
        <div class="mb-3">
            <label for="inputAddressNumber" class="form-label">Número do endereço do titular do cartão:</label>
            <input id="inputAddressNumber" type="text" name="addressNumber" class="form-control" value="{{ fake()->randomNumber(3) }}">
        </div>
        <div class="mb-3">
            <label for="inputAddressComplement" class="form-label">Complemento do endereço do titular do cartão:</label>
            <input id="inputAddressComplement" type="text" name="addressComplement" class="form-control" value="{{ fake()->randomNumber(3) }}">
        </div>
        <div class="mb-3">
            <label for="inputPhone" class="form-label">Fone com DDD do titular do cartão:</label>
            <input id="inputPhone" type="text" name="phone" class="form-control" value="{{ fake()->phoneNumber() }}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">finalizar pagamento</button>
</form>

<script>
    var ccd = document.getElementById("creditCardData");

    function checkBillingType() {
        if(document.getElementById("billingType").value !== "CREDIT_CARD") {
            localStorage.setItem("ccd", ccd.innerHTML);
            ccd.innerHTML = "";
        }
        if(document.getElementById("billingType").value === "CREDIT_CARD"){
            ccd.innerHTML = localStorage.getItem("ccd");
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        checkBillingType();
    }, false);
</script>
@endsection
