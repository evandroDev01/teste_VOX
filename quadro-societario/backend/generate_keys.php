<?php
require __DIR__ . '/vendor/autoload.php';

use phpseclib3\Crypt\RSA;


$key = RSA::createKey(4096);


file_put_contents('config/jwt/private.pem', $key->toString('PKCS8'));

file_put_contents('config/jwt/public.pem', $key->getPublicKey()->toString('PKCS8'));

echo "Chaves JWT geradas em config/jwt/\n";
