<a href="http://firebit.nl/">
    <p align="center">
      <img src="https://avatars2.githubusercontent.com/u/49287371?s=200&v=4](https://avatars2.githubusercontent.com/u/49287371?s=200&v=4)" height="100px" alt="Sublime's custom image"/>
    </p>
</a>

# KVK-API
This is a implementation of the KvK API for PHP 7+, currently this project is a work in progress and it is not yet recommended to use it in production.

## Example
```php
$kvk = new \Firebit\kvkAPI\KvKClient();
$kvk->setApiKey('API_KEY');

$result = $kvk->search([
    'name' => 'Firebit'
]);

print_r($result->firstItem());
```

## Installation
To install you can use Composer, use the following command to install kvk-php. <br/>
`` composer require firebit/kvk-php ``

## Documentation
Coming soon!

## Progress
- [X] Search Query
- [ ] Profile Query
- [X] Adapter for using the test API (for use in tests)
- [ ] PHPUnit tests
- [ ] Documentation

## License
For the license please check the [LICENSE](https://github.com/firebit/kvk-api/blob/master/LICENSE) file, this project has the MIT license.
