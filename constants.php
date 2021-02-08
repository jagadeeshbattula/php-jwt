<?php

const RESPONSE_INPUT_ERRORS_KEY = "inputErrors";

const RESPONSE_STATUS_KEY = "status";

const RESPONSE_MESSAGE_KEY = "message";

const REQUEST_METHOD_KEY = "REQUEST_METHOD";

const TOKEN_KEY = 'token';

const AUTHORIZATION_KEY = 'Authorization';

const GET_REQUEST = 'GET';

const POST_REQUEST = 'POST';

const BEARER_PREFIX = 'Bearer ';

const TOKEN_IN_VALID_ERROR_MESSAGE = "Unable to authorise your request!";

const DEFAULT_ERROR_RESPONSE_MESSAGE = "Some thing went wrong. Please try again later!";

const CURRENCY_ID_KEY = 'currency_id';

const START_DATE_KEY = 'start_date';

const END_DATE_KEY = 'end_date';

const LOAD_VALUE_KEY = 'load_value';

const AGE_KEY = 'age';

const TOTAL_KEY = 'total';

const QUOTATION_ID_KEY = 'quotation_id';

const ALL_INPUTS = [
    CURRENCY_ID_KEY,
    START_DATE_KEY,
    END_DATE_KEY,
    AGE_KEY
];

const MANDATORY_INPUTS = [
    CURRENCY_ID_KEY => 'Select a valid currency',
    START_DATE_KEY => 'Select valid start date',
    END_DATE_KEY => 'Select valid end date',
    AGE_KEY => 'Provide valid age'
];

const RESPONSE_SUCCESS_CODE = 200;

const RESPONSE_UNAUTHORIZED = 401;

const RESPONSE_NOT_FOUND_CODE = 404;

const RESPONSE_UNPROCESSABLE_ENTRY_CODE = 422;

const CURRENCIES = [
    'USD',
    'EUR',
    'GBP'
];

const MINIMUM_REQUIRED_AGE = 18;


