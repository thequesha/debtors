<?php
if (!function_exists('customAsset')) {
    /**
     * Custom asset function to return the correct URL.
     *
     * @param  string  $path
     * @return string
     */
    function customAsset($path)
    {
        return env('APP_URL') . '/' . ltrim($path, '/');
    }
}
