<?php

namespace App\Http\Controllers\payu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class CreatePaymentController extends Controller
{
    public function createPayment()
    {
        // Obtiene el usuario autenticado
        $user = Auth::user();

        // Configuración básica
        $merchantId = env('PAYU_MERCHANT_ID');  // ID del comercio
        $accountId = env('PAYU_ACCOUNT_ID');    // ID de la cuenta (por país)
        $apiKey = env('PAYU_API_KEY');      // Llave API para seguridad
        $amount = 1.00; // Mínimo 1 USD
        $currency = 'USD';  // Moneda del pago
        $referenceCode = 'UPGRADE-' . Str::uuid();  // Código único de referencia

        // Generar firma digital (requerida por PayU)
        // PayU valida que la solicitud es legítima y no ha sido alterada.
        $signature = md5($apiKey . '~' . $merchantId . '~' . $referenceCode . '~' . $amount . '~' . $currency);

        $data = [
            'merchant_id' => $merchantId,
            'account_id' => $accountId,
            'description' => 'Ser admin en SmartPark',
            'referenceCode' => $referenceCode,
            'amount' => $amount,
            'currency' => $currency,
            'buyerEmail' => $user->email,
            'signature' => $signature,
            'test' => 1, // Modo prueba activado
            'responseUrl' => route('usuario.payu.response'),
            'confirmationUrl' => route('usuario.payu.confirmation'),
        ];

        return view('payu.form', compact('data'));
    }

    public function paymentResponse(Request $request)
    {
        //Este método recibe la respuesta cuando PayU redirige al usuario:
        \Log::info('PayU Response:', $request->all());

        $status = $request->get('transactionState');
        $referenceCode = $request->get('referenceCode');
        $email = $request->get('buyerEmail');

        // Estados de PayU: 
        // 4 = APPROVED, 6 = DECLINED, 7 = PENDING
        if ($status == 4) { // Transacción aprobada
            $user = User::where('email', $email)->first();
            $adminRole = Role::where('nombre', 'admin')->first();

            if ($user && $adminRole) {
                $user->role_id = $adminRole->id;
                $user->save();

                return redirect()->route('admin.dashboard')
                    ->with('success', '¡Pago exitoso! Ahora eres administrador.');
            }

            return redirect()->route('home')
                ->with('error', 'Usuario no encontrado.');
        } elseif ($status == 6) { // Rechazada
            return redirect()->route('home')
                ->with('error', 'Pago rechazado. Intenta con otra tarjeta.');
        } elseif ($status == 7) { // Pendiente
            return redirect()->route('home')
                ->with('warning', 'Pago pendiente. Te notificaremos cuando sea procesado.');
        } else { // Otros estados
            return redirect()->route('home')
                ->with('error', 'Error en el proceso de pago. Estado: ' . $status);
        }
    }

    // Comunicación servidor-a-servidor
    // PayU → Tu Servidor (sin intermediarios)
    // Ocurre aunque el usuario cierre el navegador

    // Endpoint para confirmaciones automáticas de PayU
    public function paymentConfirmation(Request $request)
    {
        \Log::info('PayU Confirmation:', $request->all());

        // Aquí procesas la confirmación automática de PayU
        // Importante: Validar la firma para seguridad

        $status = $request->get('transactionState');
        $referenceCode = $request->get('referenceCode');
        $email = $request->get('buyerEmail');

        if ($status == 4) {
            $user = User::where('email', $email)->first();
            $adminRole = Role::where('nombre', 'admin')->first();

            if ($user && $adminRole) {
                $user->role_id = $adminRole->id;
                $user->save();
            }
        }

        // Siempre retornar 200 OK a PayU
        return response()->json(['status' => 'success']);
    }
}
