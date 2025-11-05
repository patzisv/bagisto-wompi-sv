<?php

namespace Kargo\WompiSV\PaymentMethod;

use Webkul\Payment\Payment\Payment;

class WompiSV extends Payment
{
    public $code = 'wompisv';

    public function getRedirectUrl()
    {
        return route('wompisv.start');
    }

    public function isAvailable()
    {
        return (bool) config('wompisv.enabled');
    }
}