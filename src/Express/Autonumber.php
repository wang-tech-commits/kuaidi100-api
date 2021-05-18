<?php

namespace MrwangTc\Kuaidi100\Express;

use MrwangTc\Kuaidi100\Exceptions\InvalidArgumentException;

/**
 * Notes   : 智能单号识别
 * @Date   : 2021/5/18 14:08
 * @Author : Mr.wang
 * Class Autonumber
 * @package MrwangTc\Kuaidi100\Express
 */
class Autonumber extends ExpressBase
{
    /**
     * @param string $num 快递单号
     * @return mixed
     * @throws InvalidArgumentException
     * @throws \MrwangTc\Kuaidi100\Exceptions\HttpException
     */
    public function auto(string $num)
    {
        if (empty($num)) {
            throw new InvalidArgumentException('快递单号不能为空');
        }
        $params = [
            'num' => $num,
            'key' => $this->config['key'],
        ];

        return $this->dopost($this->getUrl('autonumber'), $params);
    }
}