# Guzzle#1385

Issue URL: https://github.com/guzzle/guzzle/issues/1385


The issue is about weird characters being inserted into the response.

It only happens with the StreamHandler and it seems to me that it only
occurs when the request is chunked.

The installed package versions can be found in the `composer.lock` file.


## Usage

``` bash
$ composer install
$ docker run --rm -t -v "$PWD":/app -w /app php:5.5 php run.php
```


## Results

Using HTTP version 1.0 seems to solve the problem.
