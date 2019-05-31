<?php

namespace Firebit\kvkAPI\API;

class KvkTestAdapter extends AbstractApiAdapter
{
    public function search(array $data, string $api_key)
    {
        return $this->get("/api/v2/testsearch/companies", $data, [
            'apikey:'. $api_key
        ]);
    }
}