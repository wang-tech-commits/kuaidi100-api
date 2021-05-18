<?php

namespace MrwangTc\Kuaidi100\Express;

use MrwangTc\Kuaidi100\Exceptions\InvalidArgumentException;

/**
 * Notes   : 实时快递查询
 * @Date   : 2021/5/18 11:13
 * @Author : Mr.wang
 * Class Synquery
 * @package MrwangTc\Kuaidi100\Express
 */
class Synquery extends ExpressBase
{
    /**
     * @param string $com 查询的快递公司的编码
     * @param string $num 查询的快递单号，单号的最大长度是32个字符
     * @param string $phone 寄件人的电话号码
     * @param string $from 出发地城市
     * @param string $to 目的地城市
     * @return mixed
     * @throws \MrwangTc\Kuaidi100\Exceptions\HttpException
     */
    public function pollQuery(string $com, string $num, $phone = '', $from = '', $to = '')
    {
        if (empty($com)) {
            throw new InvalidArgumentException('物流公司编码不能为空');
        }

        if (empty($num)) {
            throw new InvalidArgumentException('快递单号不能为空');
        }
        $params = [
            'com'      => $com,
            'num'      => $num,
            'phone'    => $phone,
            'from'     => $from,
            'to'       => $to,
            'resultv2' => '1',
            'show'     => 0,
            'order'    => 'desc',
        ];
        $sign = $this->getSign($params);

        return $this->dopost($this->getUrl('synquery'), [
            'customer' => $this->config['customer'],
            'sign'     => $sign,
            'param'    => json_encode($params),
        ]);
    }
}