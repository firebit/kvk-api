<?php
namespace Firebit\kvkAPI\API;


abstract class AbstractApiAdapter
{
    protected $base_url = "https://api.kvk.nl:443";

    abstract public function search(array $data, string $api_key);

    /**
     * Used for performing get requests to the API
     *
     * @param string $url
     * @param array $data
     * @param array $headers
     * @return array
     */
    protected function get(string $url, array $data = [], array $headers = []){
        // Get cURL resource
        $curl = curl_init();

        $query = http_build_query($data);

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $this->base_url . $url . '?' . $query,
            CURLOPT_USERAGENT => 'Firebit KvK Client',
            CURLOPT_HTTPHEADER => $headers,
        ]);

        // Send the request & save response to $resp
        $response = curl_exec($curl);
        $response_info = curl_getinfo($curl);

        // Close request to clear up some resources
        curl_close($curl);

        return [
            'information' => $response_info,
            'response' => $response
        ];
    }

}
