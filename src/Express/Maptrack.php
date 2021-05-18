<?php

namespace MrwangTc\Kuaidi100\Express;

use MrwangTc\Kuaidi100\Exceptions\InvalidArgumentException;

/**
 * Notes   : 查询地图轨迹
 * @Date   : 2021/5/18 11:13
 * @Author : Mr.wang
 * Class Maptrack
 * @package MrwangTc\Kuaidi100\Express
 */
class Maptrack extends ExpressBase
{
    /**
     * @param string $com 查询的快递公司的编码
     * @param string $num 查询的快递单号，单号的最大长度是32个字符
     * @param string $phone 寄件人的电话号码
     * @param string $from 出发地城市
     * @param string $to 目的地城市
     * @param string $orderTime 订单下单时间
     * @throws InvalidArgumentException
     */
    public function mapQuery(string $com, string $num, $phone = '', $from = '', $to = '', $orderTime = '')
    {
        if (empty($com)) {
            throw new InvalidArgumentException('物流公司编码不能为空');
        }

        if (empty($num)) {
            throw new InvalidArgumentException('快递单号不能为空');
        }
        $params = [
            'com'       => $com,
            'num'       => $num,
            'phone'     => $phone,
            'from'      => $from,
            'to'        => $to,
            'show'      => 0,
            'order'     => 'desc',
            'orderTime' => $orderTime
        ];
        $sign = $this->getSign($params);

        return $this->dopost($this->getUrl('mapquery'), [
            'customer' => $this->config['customer'],
            'sign'     => $sign,
            'param'    => json_encode($params),
        ]);
    }
}