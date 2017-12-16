<?php

namespace Xu42\KuaiDi100;

class KuaiDi100
{

    /**
     * 查询物流公司代号
     *
     * @param $logisticNo string 快递单号
     *
     * @return string|null
     */
    public static function getCode($logisticNo)
    {
        $businessData = [
            'num' => $logisticNo
        ];

        $response = self::request(Utils::CODE, $businessData);

        if (is_array($response) && isset($response[0]['comCode'])) {
            return $response[0]['comCode'];
        } else {
            return null;
        }
    }


    /**
     * 即时查询
     *
     * @param $logisticCode string 物流公司编号
     * @param $logisticNo string 快递单号
     *
     * @return array|null
     */
    public static function track($logisticCode, $logisticNo)
    {
        $businessData = [
            'temp' => time(),
            'type' => $logisticCode,
            'postid' => $logisticNo,
        ];

        return self::request(Utils::TRACK, $businessData);
    }


    /**
     * 统一HTTP请求入口
     *
     * @param $apiName string 接口名称
     * @param $businessData array 业务参数
     *
     * @return array|null
     */
    private static function request($apiName, $businessData)
    {
        return Utils::httpRequest($apiName, $businessData);
    }

}