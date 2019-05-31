<?php

namespace Firebit\kvkAPI;


use Firebit\kvkAPI\API\AbstractApiAdapter;
use Firebit\kvkAPI\API\KvkAdapter;
use Firebit\kvkAPI\API\KvkTestAdapter;
use Firebit\kvkAPI\Response\SearchResponse;

class KvKClient
{

    protected $base_url = "https://api.kvk.nl:443";
    protected $api_key = "";

    static protected $adapter;
    static protected $safeSearch = true;
    static protected $safeSearchAmount = 100;

    public function __construct()
    {
        if(!isset(self::$adapter)){
            self::setProductionAdapter();
        }
    }

    public function setApiKey(string $api_key): void
    {
        $this->api_key = $api_key;
    }

    public function search(array $data): SearchResponse
    {
        $response = self::$adapter->search($data, $this->api_key);

        return new SearchResponse($response, $data, $this);

    }

    /**
     * Protection against an high amount of requests
     */

    public static function isSafeSearchEnabled(): bool
    {
        return self::$safeSearch;
    }

    public static function disableSafeSearch(): void
    {
        self::$safeSearch = false;
    }

    public static function enableSafeSearch(): void
    {
        self::$safeSearch = true;
    }

    public static function setSafeSearchAmount($amount): void
    {
        self::$safeSearchAmount = $amount;
    }

    public static function getSafeSearchAmount(): int
    {
        return self::$safeSearchAmount;
    }


    /**
     * Setting and getting different adapters
     */

    public static function setAdapter(AbstractApiAdapter $adapter): void
    {
        self::$adapter = $adapter;
    }

    public static function getAdapter(): AbstractApiAdapter
    {
        return self::$adapter;
    }

    public static function setTestAdapter(): void
    {
        self::$adapter = new KvkTestAdapter();
    }

    public static function setProductionAdapter(): void
    {
        self::$adapter = new KvkAdapter();
    }
}