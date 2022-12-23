# SOAP Engine backport

This package contains the contracts and models that allow you to create a customizable SOAP engine compatible for php 7.1.
The design looks like this:

![Engine](docs/engine.png)

* **Driver:** A driver is a combination of an encoder + decoder + metadata that can work together in order to process SOAP requests.
    * **Encoder:** Can encode mixed data into a valid SOAP Request.
    * **Decoder:** Can decode a SOAP Response into a mixed data result.
    * **Metadata:** Processes the WSDL and returns a collection of available types and methods.
* **Transport:** Sends the HTTP SOAP Request and receives the HTTP SOAP Response.

Every component above can be used seperately in order to create your own customized SOAP Engine.

# Want to help out? 💚

- [Become a Sponsor of Project author](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#sponsor)
- [Become a Sponsor of Backport author](https://github.com/php-soap-backports/.github/blob/main/HELPING_OUT.md#sponsor)
- [Contribute to project](https://github.com/php-soap/.github/blob/main/HELPING_OUT.md#contribute)
- [Contribute to backport project](https://github.com/php-soap-backports/.github/blob/main/HELPING_OUT.md#contribute)

# Installation

```shell
composer install php-soap/engine
```

## Engines

This package provides engines that can be used in a generic way:

### SimpleEngine

The SimpleEngine is a wrapper around a previous defined `Driver` and a `Transport` implementation.

```php
use Soap\Engine\SimpleEngine;

$engine = new SimpleEngine($driver,$transport);
```

### LazyEngine

You don't want to be loading WSDL files or SOAP services if you don't need to.
By wrapping an engine in a lazy engine, you can prevent any WSDL loading from happening before actually requesting a resource.

```php
use Soap\Engine\SimpleEngine;
use Soap\Engine\LazyEngine;

$engine = new LazyEngine(function () {
    return new SimpleEngine($driver, $transport);
});
```

## List of compatible components:

* [ext-soap-engine](https://github.com/php-soap-backports/ext-soap-engine): An engine based on PHP's ext-soap.
    * **ExtSoapEncoder:** Uses PHP's `SoapClient` in order to encode a mixed request body into a SOAP request.
    * **ExtSoapDecoder:** Uses PHP's `SoapClient` in order to decode a SOAP Response into mixed data.
    * **ExtSoapMetadata:** Parses the methods and types from PHP's `SoapClient` into something more usable.
    * **ExtSoapDriver:** Combines the ext-soap encoder, decoder and metadata tools into a usable `ext-soap` preset.
    * **ExtSoapClientTransport:** Uses PHP's `SoapClient` to handle SOAP requests.
    * **ExtSoapServerTransport:** Uses PHP's `SoapServer` to handle SOAP requests.
    * **TraceableTransport:** Can be used to decorate another transport and keeps track of the last request and response.