<?php

require_once __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlMultiHandler;
use GuzzleHttp\Promise;

// The example is copied as is from https://github.com/guzzle/guzzle/issues/1625
// The original package: https://github.com/Duplexmedia/parallel-pagespeed
// Some necessary modifications:
//      - "$this->client" -> "$client"
//      - Configuration of "$client"
//      - Configuration of "$urls", "$locale" and "$strategy"
//      - Copy some code from the original package

$client = new Client([
    'allow_redirects' => true,
    'base_uri' => 'https://www.googleapis.com/pagespeedonline/v2/',
    'handler' => HandlerStack::create(new CurlMultiHandler()),
    'timeout' => 0,
]);

// The issue mentioned 30+ URLs, we use 20 here
$urls = [
    'https://secure.php.net/',
    'https://getcomposer.org/',
    'http://www.phpspec.net/en/stable/',
    'http://behat.org/en/latest/',
    'https://phpunit.de/',
    'http://www.bgphp.org/',
    'https://conference.phpbenelux.eu/2016/',
    'http://httplug.io/',
    'http://phpconference.co.uk/',
    'https://www.sitepoint.com/',
    'http://docs.guzzlephp.org/en/latest/',
    'http://2016.websummercamp.com/',
    'https://www.reddit.com/',
    'https://news.ycombinator.com/',
    'http://symfony.com/',
    'https://sonata-project.org/',
    'https://www.orocrm.com/',
    'http://sylius.org/',
    'http://sulu.io/en',
    'https://travis-ci.org/',
    'https://styleci.io/',
];

$locale = 'en_US';

$strategy = 'desktop';


// Copied from https://github.com/Duplexmedia/parallel-pagespeed/blob/master/src/Service.php#L64-L66
$strategies = ($strategy == 'both') ?
            array('desktop', 'mobile') :
            array($strategy);


// ORIGINAL CODE FROM HERE


// Sorry for the verbosity, but I'm afraid there might be hidden caveats / blocking code
// in here I don't know about.

$requests = [];
// This block basically creates all the requests
foreach ($urls as $url) {
    foreach ($strategies as $strategy) { // Strategy is PageSpeed Strategy, either mobile or desktop
        $requests[$url][$strategy] = $client->getAsync('runPagespeed', [
            'query' => [
                'url' => $url,
                'locale' => $locale,
                'strategy' => $strategy
            ]
        ]);
    }
}

// This block could be omitted if Promise\settle supported nested arrays
// it processes the requests for each URL and strategy and decodes the response JSON

$promises = [];
foreach ($requests as $url => $reqs) {
    // Could it be b/c of the recursive settle here? I guess / hope not.
    $promises[$url] = Promise\settle($reqs)->then(function ($results) {
        $finalResults = [];

        foreach ($results as $strategy => $result) {
            // Do some processing with the result, like figure out whether the request succeeded and get the body, in either case
            $res = new \stdClass();
            $res->success = $result['state'] == Promise\PromiseInterface::FULFILLED;
            /** @var ResponseInterface $response */
            $response = $res->success ? $result['value'] : $result['reason']->getResponse();
            $res->data = json_decode($response->getBody()->getContents(), false);

            $finalResults[$strategy] = $res;
        }

        return $finalResults;
    });
}

Promise\settle($promises)->then(function ($results) {
    // We have the results
})->wait();
