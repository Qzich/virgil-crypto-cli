<?php

require 'base.php';

$longOptions = [
    'identity:',
];

global $config, $virgilCrypto;

$options = getopt('', $longOptions);

$identity = $options['identity'];

if (!preg_match('/^[a-zA-Z]+$/', $identity)) {
    echo 'Identity should contains only alphabetic character.';
    echo "\n";
    exit(0);
}

$keyPair = $virgilCrypto->generateKeys();

$exportedPublicKey = $virgilCrypto->exportPublicKey($keyPair->getPublicKey());

$exportedPrivateKey = $virgilCrypto->exportPrivateKey($keyPair->getPrivateKey());

$publicKeyFileName = $config['public_keys_path'] . '/' . $identity . '.public';
$privateKeyFileName = $config['private_keys_path'] . '/' . $identity . '.private';

file_put_contents($publicKeyFileName, $exportedPublicKey->getData());
file_put_contents($privateKeyFileName, $exportedPrivateKey->getData());
