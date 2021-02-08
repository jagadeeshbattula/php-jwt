<?php
$variables = [
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'php-jwt',
    'SECRET_KEY' => 'our_secret',
    'VERIFICATION_ALGORITHMS' => 'HS256',
    'ISSUER_CLAIM' => 'jagadeesh',
    'AUDIENCE_CLAIM' => 'battula',
    'AUTH_VALIDATE' => 6000,
    'FIXED_CURRENCY_RATE' => 3
];

foreach ($variables as $key => $value) {
    putenv("$key=$value");
}
