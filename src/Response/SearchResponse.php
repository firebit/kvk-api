<?php

namespace Firebit\kvkAPI\Response;

use Firebit\kvkAPI\Items\SearchItem;
use Firebit\kvkAPI\KvKClient;

class SearchResponse extends BaseResponse
{

    function __construct(array $curl_data, $query, &$kvk)
    {
        parent::__construct($curl_data, $query, $kvk);

        if($this->status_code == 200 and $this->total_items){
            foreach ($this->raw_response['data']['items'] as $item_data){
                $this->items[] = new SearchItem($item_data);
            }
        }
    }


    /**
     *
     * This function should be in BaseResponse, however there we don't know the return type yet.
     * This way your IDE can show you the properties of the SearchItem
     *
     * @return SearchItem
     */
    public function firstItem(): SearchItem
    {
        return $this->items[0];
    }

    public function getNextPage()
    {
        if($this->nextPageExists()) {
            $newQuery = $this->query;
            $newQuery['startPage'] = $this->currentPage() + 1;

            return $this->kvk->search($newQuery);

        }else{
            return $this;
        }
    }

    public function getPreviousPage()
    {
        $newQuery = $this->query;
        $newQuery['startPage'] = $this->currentPage() - 1;

        return $this->kvk->search($newQuery);
    }

    public function nextPageExists()
    {
        return (($this->currentPage() * $this->itemsPerPage()) < $this->totalItems()) ? true : false;
    }

    public function fetchAll(){

        if($this->total_items > KvKClient::getSafeSearchAmount() && KvKClient::isSafeSearchEnabled()){
            throw new \Exception("Too many total items to fetch all");
        }

        return $this->fetch($this->total_items + 1);
    }

    public function fetch(int $amount){
        $result = $this;

        if(!$this->itemsPerPage()){
            return $this;
        }

        for ($i = $this->currentPage(); $i < $amount / $this->itemsPerPage(); $i++){
            if($result->nextPageExists()){
                $result = $result->getNextPage();

                $this->items = array_merge($this->items(), $result->items());
                $this->start_page = $result->currentPage();
            }else{
                break;
            }
        }

        return $this;
    }
}