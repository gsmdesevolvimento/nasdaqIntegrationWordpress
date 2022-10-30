<?php

/**
*
* @author Guilherme Sousa
* @link https://github.com/gsmdados/nasdaq-integration-wordpress
* @version 1.0
*/

if (!defined('ABSPATH')) {
    exit('Access denied');
}

class Nasdaq {

    public static function getDataByCurl ($url) {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36');

        curl_setopt($curl, CURLOPT_REFERER, 'https://www.nasdaq.com');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($curl, CURLOPT_COOKIESESSION, true);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate,br');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Access-Control-Allow-Origin: *',
            'origin: https://www.nasdaq.com',
            'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept'
        ));

        $result = curl_exec($curl);

        $curl_info = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

        curl_close($curl);

        $result = json_decode($result, true);

        return $result;

    }

    public static function savePluginOption ($param, $value) {

        delete_option($param);

        add_option($param, $value);

    }

}