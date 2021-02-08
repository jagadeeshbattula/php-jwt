<?php
use Firebase\JWT\JWT;

function getNewJwtToken(): string
{
    $notBefore = $issuedAt = time();
    $expireAt = $issuedAt + env('AUTH_VALIDATE');
    $token = [
        "iss" => env('ISSUER_CLAIM'),
        "aud" => env('AUDIENCE_CLAIM'),
        "iat" => $issuedAt,
        "nbf" => $notBefore,
        "exp" => $expireAt
    ];

    http_response_code(RESPONSE_SUCCESS_CODE);

    return JWT::encode($token, env('SECRET_KEY'));
}

function validateJwtToken(string $encodedToken): bool
{
    try {

        $decoded = JWT::decode($encodedToken, env('SECRET_KEY'), [ env('VERIFICATION_ALGORITHMS') ]);

        if ($decoded->iss === env('ISSUER_CLAIM') &&
            $decoded->aud === env('AUDIENCE_CLAIM')) {

            return true;
        }

        return false;
    } catch (Exception $e){
        return false;
    }
}