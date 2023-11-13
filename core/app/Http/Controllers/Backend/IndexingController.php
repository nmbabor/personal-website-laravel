<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class IndexingController extends Controller
{
    public function index()
    {
        return "";
    }
    public function sendIndexingRequest()
    {
        try {
            $url = "https://app.sinbyte.com/api/indexing/";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer YOUR_API_KEY', // Replace with your API key
                'Content-Type' => 'application/json',
            ])->post($url, [
                'apikey' => env('SINBYTE_API_KEY'),
                'name' => 'Test GSA 10/09 1',
                'dripfeed' => 1,
                'method' => 'tools',
                'urls' => [
                    'http://search-engine-ranker.gsa-online.de/',
                    'https://sinbyte.com/',
                ],
            ]);

            // Check if the response status code is in the 2xx range (success)
            if ($response->successful()) {
                // Success response handling
                $responseData = $response->json(); // Convert response to JSON
                // Handle success response data here
                return response()->json($responseData);
            } else {
                // Error response handling
                $errorResponseData = $response->json(); // Convert error response to JSON
                // Handle error response data here
                return response()->json($errorResponseData, $response->status());
            }
        } catch (RequestException $e) {
            // Handle exceptions (e.g., connection errors, timeouts, etc.)
            $errorMessage = $e->getMessage();
            // Handle exception here
            return response()->json(['error' => $errorMessage], 500); // Internal Server Error
        }
    }
}
