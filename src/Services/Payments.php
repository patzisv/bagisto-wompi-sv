<?php

namespace Kargo\WompiSV\Services;

use Illuminate\Support\Facades\Http;

class Payments
{
    public function __construct(private AuthClient $auth) {}

    public function create3ds(array $order, array $card): array
    {
        $payload = [
            'monto' => round($order['amount'] ?? 0, 2),
            'tarjeta' => [
                'numeroTarjeta'   => $card['number'] ?? '',
                'cvv'             => $card['cvv'] ?? '',
                'mesVencimiento'  => (int) ($card['exp_month'] ?? 0),
                'anioVencimiento' => (int) ($card['exp_year'] ?? 0),
            ],
            'configuracion' => [
                'urlRedirect' => route('wompisv.return'),
                'urlWebhook'  => route('wompisv.webhook'),
            ],
        ];

        $token = $this->auth->token();

        return Http::withToken($token)
            ->post(rtrim(config('wompisv.api_base'), '/').'/TransaccionCompra/3DS', $payload)
            ->throw()
            ->json();
    }
}