<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCobrancaRequest;
use App\Models\Cobranca;
use App\Models\User;
use App\Services\AsaasServiceFactory;
use App\Services\CobrancaAsaasService;
use App\Services\CobrancaAsaasService\AsaasApiErrorList;
use App\Services\CobrancaAsaasService\CobrancaAsaas\Boleto;
use App\Services\CobrancaAsaasService\CobrancaAsaas\Pix;
use App\Services\CobrancaAsaasServiceDto\CreditCardAsaasDto;
use App\Services\CobrancaAsaasServiceDto\CreditCardHolderInfoAsaasDto;
use DateTimeImmutable;

class CobrancaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        //        $cobrancas = Cobranca::all();
        $cobrancas = $user->cobrancas;

        return view('cobrancas',
            [
                'user' => $user,
                'cobrancas' => $cobrancas,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('cobranca_create',
            [
                'user' => $user,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCobrancaRequest $request, User $user)
    {
        $asaasServiceFactory = new AsaasServiceFactory();
        $cobrancaAsaasService = $asaasServiceFactory->getAsaasService(CobrancaAsaasService::class);
        $creditCardAsaasDto = null;
        $creditCardHolderInfoDto = null;
        if ($request->billing_type === 'CREDIT_CARD') {
            $creditCardAsaasDto = CreditCardAsaasDto::create(
                $request->holderName,
                $request->number,
                $request->expiryMonth,
                $request->expiryYear,
                $request->ccv
            );
            $creditCardHolderInfoDto = CreditCardHolderInfoAsaasDto::create(
                $request->name,
                $request->email,
                $request->cpfCnpj,
                $request->postalCode,
                $request->addressNumber,
                $request->addressComplement,
                $request->phone,
            );
        }
        assert($cobrancaAsaasService instanceof CobrancaAsaasService);
        $cobrancaAsaas = $cobrancaAsaasService->createNewCobranca(
            $request->billing_type,
            $user->id_asaas,
            $request->value,
            DateTimeImmutable::createFromFormat('Y-m-d', $request->due_date),
            $creditCardAsaasDto,
            $creditCardHolderInfoDto,
        );
        if ($cobrancaAsaas === false) {
            return redirect()->back()->with('message', 'Erro ao criar cobrança no Asaas');
        }
        if ($cobrancaAsaas instanceof AsaasApiErrorList) {
            return redirect()->route('cobrancas.error', ['user' => $user->id])
                ->with('errorMessages', $cobrancaAsaas->getAsaasApiErrorList());
        }
        $cobranca = new Cobranca();
        $cobranca->user_id = $user->id;
        $cobranca->id_asaas = $cobrancaAsaas->getId();
        $cobranca->billing_type = $request->billing_type;
        $cobranca->value = $request->value * 100;
        $cobranca->due_date = $request->due_date;
        if ($cobrancaAsaas instanceof Boleto) {
            $cobranca->boleto_bank_slip_url = $cobrancaAsaas->getBankSlipUrl();
        }
        if ($cobrancaAsaas instanceof Pix) {
            $cobranca->pix_encoded_image = $cobrancaAsaas->getEncodedImage();
            $cobranca->pix_payload = $cobrancaAsaas->getPayload();
        }
        $cobranca->save();

        return redirect()->route('cobrancas.show', ['user' => $user->id, 'cobranca' => $cobranca->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Cobranca $cobranca)
    {
        return view('cobranca_show', ['user' => $user, 'cobranca' => $cobranca]);
    }

    public function error(User $user)
    {
        return view('cobranca_errors', ['user' => $user]);
    }
}
