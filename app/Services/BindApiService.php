<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\DNSRecord;
use Illuminate\Support\Facades\Log;


class BindApiService
{
    private $httpRequest = null;
    private $zone = 'cub.org';
    /**
     * Set HTTP headers for all requests
     */
    public function __construct()
    {
        $apiKey = config('services.bind_rest_api.api_key');

        $headers = [
            'Accept' => 'application/json',
            'X-API-Key' => $apiKey,
        ];

        $this->httpRequest = Http::withHeaders($headers);
    }

    /**
     * Get all zone records
     * @return array
     */
    public function getAllZoneRecords()
    {
        Log::channel('bindapi')->info('appel de getAllZoneRecords');

        $response = $this->httpRequest->get(config('services.bind_rest_api.base_uri') . '/dns/zone/' . $this->zone);
        $jsonData = $response->json();

        Log::info("Status Code: " . $response->getStatusCode());
        Log::info("Réponse : " . $response);

        // Create a new array to store DNSRecord objects
        $dnsRecords = [];

        // Browse the array and create a new DNSRecord for each entry
        if (isset($jsonData['records'])) {
            $records = $jsonData['records'];
            foreach ($records as $type => $items) {
                foreach ($items as $item) {
                    $dnsRecord = new DNSRecord();
                    $dnsRecord->response = $item['response'];
                    $dnsRecord->rrtype = $item['rrtype'];
                    $dnsRecord->ttl = $item['ttl'];
                    $dnsRecord->name = $type;
                    $dnsRecords[] = $dnsRecord;
                }
            }
        }

        return $dnsRecords;
    }

    /**
     * Get one zone record
     * @param $id
     * @return DNSRecord
     */
    public function getOneZoneRecord($domain, $rrtype)
    {
        Log::channel('bindapi')->info('appel de getAllZoneRecords');

        $response = $this->httpRequest->get(
            config('services.bind_rest_api.base_uri') . '/dns/record/' . $domain . $this->zone,
            [
                'record_type' => $rrtype,
            ]
        );
        $jsonData = $response->json();

        Log::info("Status Code: " . $response->getStatusCode());
        Log::info("Réponse : " . $response);

        return $jsonData;
    }

    /**
     * Create a new zone record
     * @param $rrtype
     * @param $response
     * @return DNSRecord
     */
    public function createZoneRecord($rrtype, $response)
    {
        Log::channel('bindapi')->info('appel de createZoneRecord');

        $response = $this->httpRequest->post(
            config('services.bind_rest_api.base_uri') . '/dns/record/' . $this->zone,
            [
                'rrtype' => $rrtype,
                'response' => $response,
                'ttl' => 3600,
            ]
        );
        $jsonData = $response->json();

        Log::info("Status Code: " . $response->getStatusCode());
        Log::info("Réponse : " . $response);

        return $jsonData;
    }

    /**
     * Update a zone record
     * @param $id
     * @param $rrtype
     * @param $response
     * @return DNSRecord
     */
    public function updateZoneRecord($domain, $rrtype, $response)
    {
        Log::channel('bindapi')->info('appel de updateZoneRecord');

        $response = $this->httpRequest->put(
            config('services.bind_rest_api.base_uri') . '/dns/record/' . $domain,
            [
                'rrtype' => $rrtype,
                'response' => $response,
                'ttl' => 3600,
            ]
        );
        $jsonData = $response->json();

        Log::info("Status Code: " . $response->getStatusCode());
        Log::info("Réponse : " . $response);

        return $jsonData;
    }

    /**
     * Delete a zone record
     * @param $id
     * @return DNSRecord
     */
    public function deleteZoneRecord($domain, $rrtype, $response)
    {
        Log::channel('bindapi')->info('appel de deleteZoneRecord');

        $response = $this->httpRequest->delete(
            config('services.bind_rest_api.base_uri') . '/dns/record/' . $domain,
            [
                'record_type' => $rrtype,
                'response' => $response,
                'ttl' => 3600,
            ]
        );
        $jsonData = $response->json();

        Log::info("Status Code: " . $response->getStatusCode());
        Log::info("Réponse : " . $response);

        return $jsonData;
    }
}
