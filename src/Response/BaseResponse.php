<?php

namespace Firebit\kvkAPI\Response;

use Firebit\kvkAPI\KvKClient;

/**
 * The base for all responses from the API
 *
 * Class BaseResponse
 * @package Firebit\kvkAPI\Response
 */
class BaseResponse
{
    protected $kvk;
    protected $query;

    protected $status_code;
    protected $raw_response;
    protected $request_information;

    protected $items_per_page;
    protected $start_page;
    protected $total_items;

    protected $items = [];

    function __construct(array $curl_data, $query, KvKClient &$kvk){

        $this->kvk = $kvk;
        $this->query = $query;

        $this->status_code = $curl_data['information']['http_code'];
        $this->request_information = $curl_data['information'];

        if($this->status_code == 200){
            $this->raw_response = json_decode($curl_data['response'], true);

            $this->items_per_page = $this->raw_response['data']['itemsPerPage'];
            $this->start_page = $this->raw_response['data']['startPage'];
            $this->total_items = $this->raw_response['data']['totalItems'];
        }
    }

    public function items(): array
    {
        return $this->items;
    }


    public function itemsPerPage()
    {
        return $this->items_per_page;
    }

    public function startPage()
    {
        return $this->start_page;
    }

    /*
     * Exact same as startPage but this makes more sense.
     * startPage is het KvK naming.
     */
    public function currentPage()
    {
        return $this->start_page;
    }

    public function totalItems()
    {
        return $this->total_items;
    }

    public function statusCode()
    {
        return $this->status_code;
    }

    public function rawResponse()
    {
        return $this->raw_response;
    }

    public function requestInformation()
    {
        return $this->request_information;
    }

    public function count()
    {
        return count($this->items());
    }

}
