<?php

namespace Firebit\kvkAPI\API;

class KvkAdapter extends AbstractApiAdapter
{
    /**
     * Search route for the production API
     *
     * @param array $data
     * @param string $api_key
     * @return array
     */
    public function search(array $data, string $api_key)
    {
        return $this->get("/api/v2/search/companies", $data, [
            'apikey:'. $api_key
        ]);
    }
}
