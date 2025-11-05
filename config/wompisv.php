<?php

return [
    'enabled' => env('WOMPI_SV_ENABLED', true),
    'debug'   => env('WOMPI_SV_DEBUG', false),

    'auth_url' => env('WOMPI_SV_AUTH_URL', 'https://id.wompi.sv/connect/token'),
    'api_base' => env('WOMPI_SV_API_BASE', 'https://api.wompi.sv'),

    'client_id'     => env('WOMPI_SV_CLIENT_ID'),
    'client_secret' => env('WOMPI_SV_CLIENT_SECRET'),
    'webhook_secret'=> env('WOMPI_SV_WEBHOOK_SECRET'),

    'redirect_url'  => env('WOMPI_SV_REDIRECT_URL', '/pagos/wompi/redirect'),
    'success_url'   => env('WOMPI_SV_SUCCESS_URL', '/checkout/success'),
    'fail_url'      => env('WOMPI_SV_FAIL_URL', '/checkout/failed'),
];