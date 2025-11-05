<?php

namespace Kargo\WompiSV\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Kargo\WompiSV\Services\Payments;

class RedirectController extends Controller
{
    public function __construct(private Payments $payments) {}

    public function start(Request $request)
    {
        // Estos datos deben provenir del flujo de checkout de Bagisto
        $order = [
            'id'     => session('order_id'),
            'amount' => (float) session('order_total')
        ];
        $card = [
            'number'    => $request->input('card_number'),
            'cvv'       => $request->input('card_cvv'),
            'exp_month' => $request->input('card_exp_month'),
            'exp_year'  => $request->input('card_exp_year'),
        ];

        $resp = $this->payments->create3ds($order, $card);

        if (!empty($resp['urlCompletarPago3Ds'])) {
            // TODO: marcar orden como pending en tu sistema
            return redirect()->away($resp['urlCompletarPago3Ds']);
        }

        return redirect(config('wompisv.fail_url'))
            ->with('error', 'No se pudo iniciar verificación 3DS.');
    }

    public function return(Request $request)
    {
        $status = $request->query('estado'); // Depende del esquema Wompi SV
        return $status === 'APROBADA'
            ? redirect(config('wompisv.success_url'))
            : redirect(config('wompisv.fail_url'));
    }
}