# README

Simple PHP function which checks the price of given SMS number (PL) and 
returns it with or without specified tax rate.

## Basic usage

```
// We need to include our function
include_once(__DIR__.'/GetSmsCost/GetSmsCost.php');

// Getting price with 23% TAX
$priceWithTax = getSmsCost('925123', 0.23);

// Getting price without TAX
$priceWithoutTax = getSmsCost('925123');
```

## Unit testing

To run unit tests just execute the following command:

```
php phpunit.phar /path/to/GetSmsCost/GetSmsCostTest.php
```

## License

The files in this archive are released under the [MIT LICENSE](LICENSE).
