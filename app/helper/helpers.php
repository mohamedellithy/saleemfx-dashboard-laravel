<?php
use App\Services\Currency;
use App\Services\Options;
function amount_currency($amount = null) {
    $currency = Currency::getInstance()->getCurrency();
    if($amount ==null)
        return " $currency ";

    return number_format($amount,2)." $currency ";
}

function Options(){
    $app             = app();
    $object          = $app->make('stdClass');
    $settings        = Options::getInstance()->getOptions();
    $object->setting = $settings;
    return $object;
}
