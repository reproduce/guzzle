# Guzzle#1625

Issue URL: https://github.com/guzzle/guzzle/issues/1625

Might be related: https://github.com/guzzle/guzzle/issues/1616


The issue is about performance problems when using a high number of async requests.

The issue reporter provided a very detailed code example which is going to be used.

The installed package versions can be found in the `composer.lock` file.

To see where performance might cause problems Blackfire is going to be used, more precisely `webplates/blackfire-cli` container.


## Usage

``` bash
$ composer install
$ export BLACKFIRE_CLIENT_ID=XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX
$ export BLACKFIRE_CLIENT_TOKEN=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
$ docker run --rm -t -v "$PWD":/app -e BLACKFIRE_CLIENT_ID=$BLACKFIRE_CLIENT_ID -e BLACKFIRE_CLIENT_TOKEN=$BLACKFIRE_CLIENT_TOKEN webplates/blackfire-cli blackfire run php run.php
```

(To see more advanced usage check the [docs](https://hub.docker.com/r/webplates/blackfire-cli/))


## Results

- [PHP 5.6 #1](https://blackfire.io/profiles/a98d3e6d-05ea-4096-bd44-f683247356cb/graph)
- [PHP 5.6 #2](https://blackfire.io/profiles/b752711d-2e8e-4cee-b5cb-f82fd4177c11/graph)
- [PHP 5.6 #3](https://blackfire.io/profiles/3789105a-2af7-4c7f-ae10-b42bcbf4890a/graph)
- [PHP 5.6 #4](https://blackfire.io/profiles/cfd550bf-aa0d-4c62-b847-52b1004ff7f4/graph)
- [PHP 7.0 #1](https://blackfire.io/profiles/a5b26345-ee31-46e3-a341-2f44555ae422/graph)
- [PHP 7.0 #2](https://blackfire.io/profiles/3697a532-22ac-4ab4-b467-f0bf50374c26/graph)
- [PHP 7.0 #3](https://blackfire.io/profiles/0053a06e-a80d-4b3e-970c-d4d19d4673ae/graph)
- [PHP 7.0 #4](https://blackfire.io/profiles/58667e9e-3a15-42cf-b600-69388258bc98/graph)

The measured times were pretty far from the one mentioned in the issues (5+ mins).
Also, I have to mention that the internet was quite unreliable at the time of running these tests,
so some further execution might make sense. However, in some cases I was able to measure less than
one second and I doubt that adding 20 more URLs would make such difference (5 mins) to that result,
so it does not seem to be a Guzzle issue.
