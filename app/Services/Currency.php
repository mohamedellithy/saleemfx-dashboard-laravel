<?php

namespace App\Services;
use App\Setting;
class Currency
{
    private static $instance = null;
    private $currency = 'EGP';

    private function __construct(){
        $currency = Setting::where('name','currency')->first();
        $this->currency = $currency->value;
    }

    public static function getInstance(){
        if(!self::$instance){
            return self::$instance = new Currency();
        }

        return self::$instance;
    }

    public function getCurrency(){
        return $this->currency;
    }
}
