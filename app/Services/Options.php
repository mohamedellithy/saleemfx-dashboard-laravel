<?php

namespace App\Services;
use App\Setting;
class Options
{
    private static $instance = null;
    private $setting = [];

    private function __construct(){
        $settings = Setting::pluck('value','name')->toArray();
        $this->setting = $settings;
    }

    public static function getInstance(){
        if(!self::$instance){
            return self::$instance = new Options();
        }

        return self::$instance;
    }

    public function getOptions(){
        return $this->setting;
    }
}
