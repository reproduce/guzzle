# Proxy option not working in 5.3

There has been a considerable amount of problems reported that proxy option is not working
in Guzzle 5.x

This issue reproduction aims to prove that it works (and tries to be an example as well).

[Squid](https://hub.docker.com/r/sameersbn/squid/) is used as a proxy server.


## Usage

``` bash
$ composer install
$ docker-compose run php php run.php
$ docker-compose run php php run.php fail
```


## Results

Results should show that every request with a properly configured proxy should succeed,
and every request with an invalid proxy should fail
(meaning that Guzzle actually tries to send the requests through the proxy)

Valid proxy result:

```
Using proxy (everything should be ok)

Using default proxy [OK]
Using HTTP proxy [OK]
Using HTTPS proxy [OK]
Using TCP proxy [OK]
Using HTTP proxy from env var [OK]
```


Invalid proxy result:

```
Using invalid proxy (everything should fail)

Using default proxy [ERROR]
Using HTTP proxy [ERROR]
Using HTTPS proxy [ERROR]
Using TCP proxy [ERROR]
Using HTTP proxy from env var [ERROR]
```
