<?php

use Virgil\Sdk\Buffer;

require 'base.php';

$longOptions = [
    'with:',
];

$encryptedContent = stream_get_contents(fopen("php://stdin", "r"));

global $config, $virgilCrypto;

$options = getopt('', $longOptions);

$decryptWithIdentity = $options['with'];

$privateKeyFileName = realpath($config['private_keys_path'] . '/' . $decryptWithIdentity . '.private');

if (!file_exists($privateKeyFileName)) {
    echo 'Identity ' . $decryptWithIdentity .
         ' not found. Be sure you generated keys for identity with this name or have private key at least.';
    echo "\n";
    exit(0);
}

$privateKeyReference = $virgilCrypto->importPrivateKey(new Buffer(file_get_contents($privateKeyFileName)));

$originalContent = $virgilCrypto->decrypt(Buffer::fromBase64($encryptedContent), $privateKeyReference);

echo $originalContent->toString();
echo "\n";
