# Kargo Wompi SV for Bagisto

Gateway de pago **Wompi El Salvador (3DS)** para **Bagisto 2.x** (Laravel 10/11).

## Requisitos
- PHP 8.1+
- Laravel 10/11
- Bagisto 2.2–2.4
- Credenciales Wompi SV (client_id, client_secret, webhook_secret)

## Instalación
```bash
composer require kargo/wompi-sv-bagisto
php artisan vendor:publish --tag=wompisv-config
```
Excluye el webhook del CSRF (`/pagos/wompi/webhook`).

## Variables .env
```
WOMPI_SV_ENABLED=true
WOMPI_SV_DEBUG=false

WOMPI_SV_AUTH_URL=https://id.wompi.sv/connect/token
WOMPI_SV_API_BASE=https://api.wompi.sv

WOMPI_SV_CLIENT_ID=xxx
WOMPI_SV_CLIENT_SECRET=xxx
WOMPI_SV_WEBHOOK_SECRET=xxx

WOMPI_SV_REDIRECT_URL=/pagos/wompi/redirect
WOMPI_SV_SUCCESS_URL=/checkout/success
WOMPI_SV_FAIL_URL=/checkout/failed
```

## Rutas expuestas
- `GET /pagos/wompi/start` → inicia flujo 3DS.
- `GET {WOMPI_SV_REDIRECT_URL}` → retorno del banco.
- `POST /pagos/wompi/webhook` → notificación Wompi (firmada HMAC).

## Notas
- El cierre real de la orden se hace por **webhook** (fuente de verdad).
- No loguear PAN/CVV. Sanitiza logs.
- Estructura lista para extender con tokenización y refunds.