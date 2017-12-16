<?php

namespace Xu42\KuaiDi100;

class Utils
{
    const CODE = 'https://m.kuaidi100.com/autonumber/auto?';
    const TRACK = 'https://m.kuaidi100.com/query?';

    /**
     *  提交数据
     *
     * @param $api string 接口
     * @param array $businessData 业务数据
     *
     * @return array|null HTTP响应
     */
    public static function httpRequest($api, $businessData)
    {
        $params = '';
        foreach ($businessData as $key => $value) {
            $params .= $key . '=' . $value . '&';
        }

        $responseJson = self::curlRequest($api . $params);

        return json_decode($responseJson, true);
    }


    private static function curlRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:24.0) Gecko/20100101 Firefox/24.0');
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}