<?php

namespace App\Contracts\Payment;

interface PaymentGatewayInterface
{
    /**
     * Generate a payment URL or session for the order.
     *
     * @param string $orderId
     * @param float $amount
     * @param array $metadata
     * @return string The payment URL
     */
    public function generatePaymentUrl(string $orderId, float $amount, array $metadata = []): string;

    /**
     * Verify a webhook payload from the payment gateway.
     *
     * @param array $payload
     * @param string $signature
     * @return bool
     */
    public function verifyWebhook(array $payload, string $signature): bool;

    /**
     * Process a refund for a given transaction.
     *
     * @param string $transactionId
     * @param float|null $amount
     * @return bool
     */
    public function refund(string $transactionId, ?float $amount = null): bool;
}
