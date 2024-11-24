# Exspecto

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.2-8892BF.svg)](https://php.net/)

Small PHP DSL for synchronizing asynchronous operations (busy-waiting).

A simple and useful library recommended especially for testing asynchronous systems.
Exspecto allows you to express expectations of an asynchronous system in a concise and easy to read manner. Example:

```php
await()->atMost(1)->until(function() {
    return customerStatusIsUpdated();
});
```

You can use `pollInterval` to set how often the condition should be checked (default value is 100 milliseconds):

```php
await()->atMost(3)->pollInterval(200)->until(function() {
    return customerStatusIsUpdated();
});
```

You can also await for given value in case the returning method (closure) could throw an exception:
```php
$value = await()->atMost(3)->pollInterval(200)->on(fn() => getValue());
```

---

*exspecto* - from latin: *wait for*, *await*

## Install

```shell
composer require akondas/exspecto
```

## Roadmap

- [ ] `untilAsserted` for example: `untilAsserted('UserRepository::size', equaltTo(3))`
- [ ] support different poll interval strategy (fixed, fibonacci, iterative)
- [ ] `ignoreExceptions` do not stop when exceptions occur (`ignoreException(string $exceptionClass)`)
- [ ] `atLeast`
- [ ] `unitlNotNull`, `untilNull` etc.

## License

Exspecto is released under the MIT Licence. See the bundled LICENSE file for details.

## Author

Arkadiusz Kondas (@ArkadiuszKondas)
