# Guzzle#1663

Issue URL: https://github.com/guzzle/guzzle/issues/1663


The issue is about response being truncated when the server responds with 500 status code.

The installed package versions can be found in the `composer.lock` file.


## Usage

``` bash
$ composer install
$ docker-compose run --rm reproduce
```


## Results

The correct body is returned.

```
HTTP/1.1 500 Internal Server Error
Host: server
Connection: close
X-Powered-By: PHP/7.0.11
Content-Type: application/json
Content-Length: 31

{"errors":{"oh_my":"Oh my..."}}
```
