<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (! function_exists('getCurrentLocale')) {
    /**
     * @return mixed
     */
    function getCurrentLocale()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (! function_exists('getCurrentLocaleName')) {
    /**
     * @return mixed
     */
    function getCurrentLocaleName()
    {
        return LaravelLocalization::getCurrentLocaleName();
    }
}

if (! function_exists('getSupportedLocales')) {
    /**
     * @return mixed
     */
    function getSupportedLocales()
    {
        return LaravelLocalization::getSupportedLocales();
    }
}

if (! function_exists('getLocalizedURL')) {
    /**
     * @param null $localeCode
     * @param null $url
     * @param array $attributes
     * @param false $forceDefaultLocation
     * @return mixed
     */
    function getLocalizedURL($localeCode = null, $url = null, $attributes = [], $forceDefaultLocation = false)
    {
        return LaravelLocalization::getLocalizedURL($localeCode, $url, $attributes, $forceDefaultLocation);
    }
}

if (! function_exists('localizeURL')) {
    /**
     * @param null $url
     * @param null $locale
     * @return mixed
     */
    function localizeURL($url = null, $locale = null)
    {
        return LaravelLocalization::localizeURL($url, $locale);
    }
}
