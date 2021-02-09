<?php
use Carbon\Carbon;

function sanitizeInputs(array $requestData) : array
{
    $sanitizedInputs = [];

    foreach (ALL_INPUTS as $input) {
        $sanitizedInputs[$input] = filter_var($requestData[$input], FILTER_SANITIZE_STRING);
    }

    return $sanitizedInputs;
}

function validateInputs(array $inputs) : array
{
    $errors = [];

    foreach (MANDATORY_INPUTS as $key => $errorMessage) {

        switch ($key) {
            case CURRENCY_ID_KEY:
                if (!in_array($inputs[$key], CURRENCIES)) {
                    $errors[$key] = $errorMessage;
                }
                break;

            case START_DATE_KEY:
            case END_DATE_KEY:
                if (Carbon::createFromFormat('Y-m-d', $inputs[$key]) === false) {
                    $errors[$key] = $errorMessage;
                }
                break;

            case AGE_KEY:
                $ages = explode(',', $inputs[$key]);

                if ($ages[0] < MINIMUM_REQUIRED_AGE) {
                    $errors[$key] = $errorMessage;
                }

                foreach ($ages as $age) {
                    if ($age > MAXIMUM_ALLOWED_AGE) {

                        $errors[SECONDARY_AGE] = MANDATORY_INPUTS[SECONDARY_AGE];
                    }
                }
                break;
        }
    }

    return $errors;
}
