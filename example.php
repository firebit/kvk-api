<?php

require "vendor/autoload.php";

\Firebit\kvkAPI\KvKClient::setTestAdapter();

$kvk = new \Firebit\kvkAPI\KvKClient();

$result = $kvk->search([
    'q' => 'a'
]);

if($result->firstItem()->is_branch === true){
    print "Is an boolean";
}

print_r(gettype($result->firstItem()));



