<?php

require '../vendor/autoload.php';
include "../constants.php";
include "../autoload.php";
include "../app/authorise.php";
include "../app/validate.php";
include "../database/connection.php";
include "../app/processQuote.php";

if ($_SERVER[REQUEST_METHOD_KEY] === GET_REQUEST) {

    http_response_code(RESPONSE_SUCCESS_CODE);
    echo json_encode([
        TOKEN_KEY => getNewJwtToken()
    ]);
    exit();
}

if ($_SERVER[REQUEST_METHOD_KEY] === POST_REQUEST) {

    if (array_key_exists(AUTHORIZATION_KEY, getallheaders())) {
        $authHeader = getallheaders()[AUTHORIZATION_KEY];
        $token = str_replace(BEARER_PREFIX, '', $authHeader);

        if (validateJwtToken($token)) {
            $requestData = (array)json_decode(file_get_contents('php://input'));
            $inputs = sanitizeInputs($requestData);
            $errors = validateInputs($inputs);

            if (!empty($errors)) {
                http_response_code(RESPONSE_UNPROCESSABLE_ENTRY_CODE);
                echo json_encode([
                    RESPONSE_STATUS_KEY => false,
                    RESPONSE_INPUT_ERRORS_KEY => $errors
                ]);
                exit();
            }

            $quotePrice = processQuote($inputs);

            /**
             * @todo Store input and quote in Database
             */

            http_response_code(RESPONSE_SUCCESS_CODE);
            echo json_encode([
                RESPONSE_STATUS_KEY => true,
                RESPONSE_MESSAGE_KEY => [
                    TOTAL_KEY => $quotePrice,
                    CURRENCY_ID_KEY => $inputs[CURRENCY_ID_KEY],
                    QUOTATION_ID_KEY => 1
                ]
            ]);

            exit();
        }
    }

    http_response_code(RESPONSE_UNAUTHORIZED);
    echo json_encode([
        RESPONSE_STATUS_KEY => false,
        RESPONSE_MESSAGE_KEY => TOKEN_IN_VALID_ERROR_MESSAGE
    ]);
    exit();
}

http_response_code(RESPONSE_NOT_FOUND_CODE);
echo json_encode([
    RESPONSE_STATUS_KEY => false,
    RESPONSE_MESSAGE_KEY => DEFAULT_ERROR_RESPONSE_MESSAGE
]);
exit();