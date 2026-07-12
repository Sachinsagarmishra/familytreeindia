<?php

class RazorpayHelper {
    public static function settings() {
        global $site;

        $mode = isset($site['razorpay_mode']) && $site['razorpay_mode'] === 'live' ? 'live' : 'test';

        return [
            'mode' => $mode,
            'key_id' => $site["razorpay_{$mode}_key_id"] ?? '',
            'key_secret' => $site["razorpay_{$mode}_key_secret"] ?? '',
            'webhook_secret' => $site["razorpay_{$mode}_webhook_secret"] ?? '',
            'currency' => $site['razorpay_currency'] ?? 'INR',
        ];
    }

    public static function isConfigured() {
        $settings = self::settings();
        return !empty($settings['key_id']) && !empty($settings['key_secret']);
    }

    public static function request($method, $endpoint, $payload = null) {
        $settings = self::settings();

        if (empty($settings['key_id']) || empty($settings['key_secret'])) {
            throw new Exception('Razorpay keys are not configured.');
        }

        if (!function_exists('curl_init')) {
            throw new Exception('PHP cURL extension is required for Razorpay API calls.');
        }

        $ch = curl_init('https://api.razorpay.com/v1' . $endpoint);
        $headers = ['Content-Type: application/json'];

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));
        curl_setopt($ch, CURLOPT_USERPWD, $settings['key_id'] . ':' . $settings['key_secret']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($payload !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new Exception('Razorpay API connection failed: ' . $error);
        }

        $data = json_decode($response, true);

        if ($status < 200 || $status >= 300) {
            $message = $data['error']['description'] ?? 'Razorpay API request failed.';
            throw new Exception($message);
        }

        return $data;
    }

    public static function verifyCheckoutSignature($orderId, $paymentId, $signature) {
        $settings = self::settings();
        $expected = hash_hmac('sha256', $orderId . '|' . $paymentId, $settings['key_secret']);
        return hash_equals($expected, $signature);
    }

    public static function verifyWebhookSignature($rawBody, $signature) {
        $settings = self::settings();

        if (empty($settings['webhook_secret'])) {
            return false;
        }

        $expected = hash_hmac('sha256', $rawBody, $settings['webhook_secret']);
        return hash_equals($expected, $signature);
    }
}
