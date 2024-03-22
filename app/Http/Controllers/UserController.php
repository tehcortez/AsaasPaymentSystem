<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AsaasServiceFactory;
use App\Services\UsuarioAsaasService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return view('users',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asaasServiceFactory = new AsaasServiceFactory();
        $usuarioAsaasService = $asaasServiceFactory->getAsaasService(UsuarioAsaasService::class);
        assert($usuarioAsaasService instanceof UsuarioAsaasService);
        $usuarioAsaas = $usuarioAsaasService->createNewUser($request->name, $request->cpf);
        if (! $usuarioAsaas) {
            return redirect()->back()->with('message', 'Error creating user on Asaas');
        }
        $createdUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'id_asaas' => $usuarioAsaas->getId(),
        ]);
        if ($createdUser) {
            return redirect()->route('users.show', ['user' => $createdUser->id])->with('message', 'User created successfully');
        }

        return redirect()->back()->with('message', 'Error creating user locally');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user_show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user_edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $isUpdated = $user->update($request->except(['_token', '_method']));

        if ($isUpdated) {
            return redirect()->route('users.show', ['user' => $user->id])->with('message', 'User updated successfully');
        }

        return redirect()->back()->with('message', 'Error updating user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $isDeleted = $user->delete();

        if ($isDeleted) {
            return redirect()->route('users.index')->with('message', 'User deleted successfully');
        }

        return redirect()->back()->with('message', 'Error deleting user');
    }
}
