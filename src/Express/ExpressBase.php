<?php

namespace MrwangTc\Kuaidi100\Express;

use GuzzleHttp\Client;
use MrwangTc\Kuaidi100\Exceptions\HttpException;
use MrwangTc\Kuaidi100\Exceptions\InvalidArgumentException;

class ExpressBase
{
    protected $config = [];

    protected $url = [];

    public function __construct()
    {
        $config = config('kuaidi');

        if (empty($config['key'])) {
            throw new InvalidArgumentException('客户授权key不能为空');
        }
        if (empty($config['customer'])) {
            throw new InvalidArgumentException('公司编号不能为空');
        }
        if (empty($config['domain'])) {
            throw new InvalidArgumentException('接口地址没配置');
        }

        $this->config = $config;
    }

    /**
     * Notes   : 需要用签名的地方调用一下
     * @Date   : 2021/5/18 11:06
     * @Author : Mr.wang
     * @param $params
     * @return string
     */
    protected function getSign($params)
    {
        return strtoupper(md5(json_encode($params) . $this->config['key'] . $this->config['customer']));
    }

    /**
     * Notes   : 所有接口的地址集合
     * @Date   : 2021/5/18 11:33
     * @Author : Mr.wang
     * @param $key
     * @return string[]
     */
    protected function getUrl($key)
    {
        $data = [
            'synquery' => $this->config['domain'] . '/poll/query.do',
        ];
        return $data[$key];
    }

    /**
     * Notes   : 统一执行接口调用
     * @Date   : 2021/5/18 11:27
     * @Author : Mr.wang
     * @param $url
     * @param $formParams
     * @return mixed
     * @throws HttpException
     */
    protected function dopost($url, $formParams)
    {
        try {
            $Client = new Client();
            $response = $Client->post($url, ['form_params' => $formParams]);
            $result = json_decode($response->getBody()->getContents());
            return $result;
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}