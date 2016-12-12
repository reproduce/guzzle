<?php

require_once __DIR__.'/vendor/autoload.php';

use Aws\Credentials\CredentialProvider;

$provider = CredentialProvider::chain(CredentialProvider::env(), CredentialProvider::ini(), CredentialProvider::instanceProfile(), CredentialProvider::ecsCredentials());
call_user_func($provider)->wait();
