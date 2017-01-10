<?php

use Virgil\Sdk\Buffer;

require 'base.php';

$longOptions = [
    'for:',
];

global $config, $virgilCrypto;

$options = getopt('', $longOptions);

//attention - no validation
$content = stream_get_contents(fopen("php://stdin", "r"));

$encryptForIdentities = $options['for'];

$identities = preg_split('/,/', $encryptForIdentities);

$identities = array_map(
    function ($identity) {
        return trim($identity);
    },
    $identities
);

$publicKeyReferences = [];

foreach ($identities as $identity) {
    $publicKeyFileName = realpath($config['public_keys_path'] . '/' . $identity . '.public');

    if (!file_exists($publicKeyFileName)) {
        echo 'Identity ' . $identity .
             ' not found. Be sure you generated keys for identity with this name or have public key at least.';
        echo "\n";
        exit(0);
    }

    $publicKeyReferences[] = $virgilCrypto->importPublicKey(new Buffer(file_get_contents($publicKeyFileName)));
}

echo $virgilCrypto->encrypt($content, $publicKeyReferences)
                  ->toBase64()
;
echo "\n";

