<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 12:35:32
 * Description: SaleController.php.php
 */

namespace App\Http\Controllers;

use App\Models\Payment;

use App\Services\RazorpayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RazorPayController extends Controller
{
    protected $razorpayService;

    public function __construct(RazorpayService $razorpayService)
    {
        $this->razorpayService = $razorpayService;
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function payment(Request $request)
    {
        // Log::info('Payment method called');
        $request->validate([
            'razorpay_payment_id' => 'required|string',
        ]);

        $paymentId = $request->input('razorpay_payment_id');

        if ($request->filled('razorpay_payment_id')) {
            $response = $this->razorpayService->capturePayment($paymentId);
            Log::info('Razorpay response:', $response);

            if (is_array($response) && isset($response['status']) && $response['status'] === 'captured') {
                Payment::create([
                'payment_id'   => $response['id'],
                'order_id'     => $response['order_id'] ?? null,
                'status'       => $response['status'],
                'amount'       => $response['amount'],
                'currency'     => $response['currency'],
                'method'       => $response['method'] ?? null,
                'email'        => $response['email'] ?? null,
                'contact'      => $response['contact'] ?? null,
                'raw_response' => json_encode($response),
            ]);
                return redirect()->route('products.buy.success');
            }

            $errorMessage = is_string($response) ? $response : 'Payment failed or already captured.';
            Log::warning('Payment capture failed: ' . $errorMessage);

            return is_string($response) ? $response : 'Payment failed or already captured.';
        }

        return 'Payment ID is missing.';
    }

    /**
     * Payment success page
     * @return [type]
     */
    public function success()
    {
        return view('pages.product.success', [
            'message' => 'Payment successful! Thank you for your purchase.',
        ]);
    }
}
