@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow p-5 w-50 text-center">
            <h3 class="mb-4">Completa tu pago para ser Admin</h3>
            <p class="text-muted mb-4">Pago único de $1.00 USD</p>

            <form method="POST" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                @csrf
                <input type="hidden" name="merchantId" value="{{ $data['merchant_id'] }}">
                <input type="hidden" name="accountId" value="{{ $data['account_id'] }}">
                <input type="hidden" name="description" value="{{ $data['description'] }}">
                <input type="hidden" name="referenceCode" value="{{ $data['referenceCode'] }}">
                <input type="hidden" name="amount" value="{{ $data['amount'] }}">
                <input type="hidden" name="currency" value="{{ $data['currency'] }}">
                <input type="hidden" name="signature" value="{{ $data['signature'] }}">
                <input type="hidden" name="test" value="{{ $data['test'] }}">
                <input type="hidden" name="buyerEmail" value="{{ $data['buyerEmail'] }}">
                <input type="hidden" name="responseUrl" value="{{ $data['responseUrl'] }}">
                <input type="hidden" name="confirmationUrl" value="{{ $data['confirmationUrl'] }}">

                <button type="submit" class="btn btn-success w-100 rounded-pill py-2">
                    💳 Pagar $1.00 USD
                </button>
            </form>

            <div class="mt-4 p-3 bg-light rounded">
                <small class="text-muted">
                    <strong>Modo Prueba:</strong> Usa tarjetas de prueba de PayU.<br>
                    Para aprobar: Incluye "APPROVED" en nombre y CVV: 777
                </small>
            </div>
        </div>
    </div>
@endsection