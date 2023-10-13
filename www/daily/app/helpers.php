<?php
if (!function_exists('getLocale')) {
    function getLocale()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case "en":
                return 'English';
            case "vi":
                return 'Viet Nam';
            case "my":
                return 'Myanmar';
            default:
                return 'Myanmar';
        }
    }
}

if (!function_exists('maskStatusPoint')) {
    function maskStatusPoint($st)
    {
        switch ($st) {
            case 0:
                return 'Pedding';
            case 2:
                return 'Success';
            case 3:
                return 'Failed';
            default:
                return $st;
        }
    }
}