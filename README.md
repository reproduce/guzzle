# Guzzle#1610

Issue URL: https://github.com/guzzle/guzzle/issues/1610


The issue is about response being truncated.

The installed package versions can be found in the `composer.lock` file.


## Usage

``` bash
$ composer install
$ docker-compose run --rm reproduce
```


## Results

The correct body is returned for long bodies.

```
Response length: 18029
Stream length: 18029
Body length: 18029
```
