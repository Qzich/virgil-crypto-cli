<?php

use Virgil\Sdk\Cryptography\VirgilCrypto;

require __DIR__ . '/../vendor/autoload.php';

$config = [
    'public_keys_path' => __DIR__ . '/../' . 'keys/public_keys',
    'private_keys_path' => __DIR__ . '/../' . 'keys/private_keys'
];

$virgilCrypto = new VirgilCrypto();
