<?php

/**
 * Created By: JISHNU T K
 * Date: 2025/07/07
 * Time: 12:50:42
 * Description: RazorpayService.php
 */

namespace App\Services;

use Razorpay\Api\Api;
use Exception;
use Illuminate\Support\Facades\Log;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(config('razorpay.key'), config('razorpay.secret'));
    }

    /**
     * Capture a Razorpay payment.
     *
     * @param string $paymentId
     * @return array|string
     */
    public function capturePayment(string $paymentId)
    {
        try {
            $payment = $this->api->payment->fetch($paymentId);

            if ($payment && $payment['status'] !== 'captured') {
                $response = $payment->capture(['amount' => $payment['amount']]);
                return $response->toArray();
            }

            return $payment->toArray();
        } catch (Exception $e) {
            Log::error('Razorpay Capture Error: ' . $e->getMessage());
            return 'Error capturing payment: ' . $e->getMessage();
        }
    }
}
