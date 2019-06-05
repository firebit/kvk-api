<?php

require "vendor/autoload.php";

\Firebit\kvkAPI\KvKClient::setTestAdapter();

$kvk = new \Firebit\kvkAPI\KvKClient();

$result = $kvk->search([
    'q' => 'a'
]);

print_r(gettype($result->firstItem()));



