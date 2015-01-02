# README

Simple PHP function which checks the price of given SMS number (PL) and 
returns it with or without specified tax rate.

## Basic usage

```
// We need to include our function
include_once(__DIR__.'/GetSmsCost/GetSmsCost.php');

// Getting price with 23% tax
$priceWithTax = getSmsCost('925123', 0.23);

// Getting price without tax
$priceWithoutTax = getSmsCost('925123');
```

## License

The files in this archive are released under the [MIT LICENSE](LICENSE).
