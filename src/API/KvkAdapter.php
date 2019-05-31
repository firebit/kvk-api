<?php

namespace Firebit\kvkAPI\API;

class KvkAdapter extends AbstractApiAdapter
{
    public function search(array $data, string $api_key)
    {
        return $this->get("/api/v2/search/companies", $data, [
            'apikey:'. $api_key
        ]);
    }
}