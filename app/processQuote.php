<?php
use Carbon\Carbon;

function processQuote(array $inputs): float
{
    $totalPrice = 0;
    $ages = explode(',', $inputs[AGE_KEY]);

    if (!empty($ages)) {
        $endDate = Carbon::parse($inputs[END_DATE_KEY])->addDay();
        $tripLength = Carbon::parse($inputs[START_DATE_KEY])->diffInDays($endDate);

        foreach ($ages as $age) {
            $ageLoad = getAgeLoad(intval($age));

            if ($ageLoad) {
                $price = env('FIXED_CURRENCY_RATE') * $ageLoad * $tripLength;

                $totalPrice = $totalPrice + $price;
            }
        }
    }

    return round($totalPrice, 2);
}

function getAgeLoad(int $age)
{
    $databaseConnection = setDatabaseConnection();

    $sql = "SELECT load_value FROM age_loads WHERE start <= ? AND end >= ? LIMIT 1;";
    $stmt = $databaseConnection->prepare($sql);
    if ($stmt->bind_param("ii", $age, $age)) {
        $stmt->execute();

        $result = $stmt->get_result();
        $fields = $result->fetch_assoc();

        return $fields[LOAD_VALUE_KEY] ?? null;
    }
}
