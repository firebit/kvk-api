<?php

namespace Firebit\kvkAPI;


use Firebit\kvkAPI\API\AbstractApiAdapter;
use Firebit\kvkAPI\API\KvkAdapter;
use Firebit\kvkAPI\API\KvkTestAdapter;
use Firebit\kvkAPI\Response\SearchResponse;

/**
 * Client used for interfacing with the KvK API
 *
 * Class KvKClient
 * @package Firebit\kvkAPI
 */
class KvKClient
{

    protected $base_url = "https://api.kvk.nl:443";
    protected $api_key = "";

    // Used to store settings on what adapter to use and if safe search is enabled
    static protected $adapter;
    static protected $safeSearch = true;
    static protected $safeSearchAmount = 100;

    public function __construct()
    {
        if(!isset(self::$adapter)){
            self::setProductionAdapter();
        }
    }

    /**
     * Sets the API key
     *
     * @param string $api_key
     */
    public function setApiKey(string $api_key): void
    {
        $this->api_key = $api_key;
    }

    /**
     * Perform a search request
     *
     * @param array $data
     * @return SearchResponse
     */
    public function search(array $data): SearchResponse
    {
        $response = self::$adapter->search($data, $this->api_key);

        return new SearchResponse($response, $data, $this);

    }

    /**
     * For Safe Search (Protection against an high amount of requests)
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

    /**
     * Change the adapter to make use of either the Production API or the Test API.
     * This can be useful for PHPUnit tests or local development, to lower the cost of the API.
     *
     * @param AbstractApiAdapter $adapter
     */
    public static function setAdapter(AbstractApiAdapter $adapter): void
    {
        self::$adapter = $adapter;
    }

    /**
     * Returns the adapter being used.
     *
     * @return AbstractApiAdapter
     */
    public static function getAdapter(): AbstractApiAdapter
    {
        return self::$adapter;
    }

    /**
     * Set the adapter to the KvkTestAdapter
     */
    public static function setTestAdapter(): void
    {
        self::$adapter = new KvkTestAdapter();
    }

    /**
     * Set the adapter to the KvkAdapter (Production)
     */
    public static function setProductionAdapter(): void
    {
        self::$adapter = new KvkAdapter();
    }
}
