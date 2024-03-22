<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $client = new \GuzzleHttp\Client();
        $saasApikey = Config::get('app.asaas_apikey');

        $response = $client->request('GET', 'https://sandbox.asaas.com/api/v3/customers', [
            'headers' => [
                'accept' => 'application/json',
                'access_token' => $saasApikey,
            ],
        ]);
        $jsonObj = json_decode($response->getBody(), null, 512, JSON_THROW_ON_ERROR);
        foreach ($jsonObj->data as $customer) {
            User::factory()->create([
                'name' => $customer->name,
                'cpf' => $customer->cpfCnpj,
                'id_asaas' => $customer->id,
            ]);
        }

        //        User::factory(10)->create();
    }
}
