<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    /**
     * Create a payment link for the specified amount.
     *
     * @param  int  $amount
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPaymentLink($amount)
    {
        $amount = (int) $amount;
        // Initialize Guzzle client
        $client = new Client();

        // Prepare the request body
        $body = [
            'data' => [
                'attributes' => [
                    'amount' => $amount, // Amount passed as parameter (e.g., 10000 = 100.00 PHP)
                    'description' => 'RiderShield',
                    'remarks' => 'This is encrypted and secured.',
                ],
            ],
        ];

        // Send POST request to PayMongo API
        try {
            $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
                'json' => $body, // Send the data as JSON
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => env('PAYMONGO_API_KEY'), // Using the env variable
                    'Content-Type' => 'application/json',
                ],
            ]);

            // Return the PayMongo response
            return response()->json(json_decode($response->getBody()->getContents()), $response->getStatusCode());
        } catch (\Exception $e) {
            // Handle errors and return a meaningful response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
