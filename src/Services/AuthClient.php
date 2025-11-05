<?php

namespace Kargo\WompiSV\Services;

use Illuminate\Support\Facades\Http;

class AuthClient
{
    public function token(): string
    {
        $resp = Http::asForm()->post(config('wompisv.auth_url'), [
            'grant_type'    => 'client_credentials',
            'client_id'     => config('wompisv.client_id'),
            'client_secret' => config('wompisv.client_secret'),
        ])->throw()->json();

        return $resp['access_token'] ?? '';
    }
}