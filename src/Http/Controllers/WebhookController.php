<?php

namespace Kargo\WompiSV\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $raw  = $request->getContent();
        $sig  = $request->header('wompi_hash');
        $calc = hash_hmac('sha256', $raw, config('wompisv.webhook_secret'));

        if (!$sig || !hash_equals($sig, $calc)) {
            return response('Invalid signature', Response::HTTP_UNAUTHORIZED);
        }

        $event = json_decode($raw, true);

        // TODO: localizar la orden usando identificadores del evento (idTransaccion/referencia)
        // Actualizar estado: paid/failed/pending. Manejar idempotencia.
        return response('OK', 200);
    }
}