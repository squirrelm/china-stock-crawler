<?php
/**
 * 股票基本信息
 *
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/24 0024
 * Time: 10:17
 */

namespace models;


class Stock
{
    const STOCK_TYPE_A_SHARE = 'A';
    const STOCK_TYPE_B_SHARE = 'B';
    const STOCK_TYPE_INDEX = 'I';

    const STOCK_EXCHANGE_SHANGHAI = 'SH';
    const STOCK_EXCHANGE_SHENZHEN = 'SZ';

    //TODO
    const STOCK_STATUS_NORMAL = 'N';
    const STOCK_STATUS_SUSPENDED = 'S'; // 停牌
    const STOCK_STATUS_TEMPORARY_SUSPENDED = 'TS';  // 临时停牌
    const STOCK_STATUS_TEMPORARY_SUSPENDED_1H = 'TS1H';  // 临时停牌1小时
    const STOCK_STATUS_SUSPENDED_HALF = 'PH';   // 停牌1/2
    const STOCK_STATUS_HALT = 'H'; // 暂停
    const STOCK_STATUS_UNRECORDED = 'UR'; // 无记录
    const STOCK_STATUS_UNLISTED = 'U'; // 未上市
    const STOCK_STATUS_DELISTED = 'D'; // 已退市

    private $code;
    private $name;
    private $symbol;
    private $type;
    private $exchange;
    private $pinyin;
    private $status;

    public function isST()
    {
        return preg_match('/S/', $this->getName());
    }

    public function isNew()
    {
        return preg_match('/^N/', $this->getName());
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return mixed
     */
    public function getTypeStr()
    {
        switch ($this->getType()) {
            case self::STOCK_TYPE_A_SHARE :
                return "A股";
            case self::STOCK_TYPE_B_SHARE :
                return "B股";
            case self::STOCK_TYPE_INDEX :
                return "指数";
        }
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @throws \Exception
     */
    public function setType($type)
    {
        $type = strtoupper($type);
        switch ($type) {
            case self::STOCK_TYPE_A_SHARE :
                break;
            case self::STOCK_TYPE_B_SHARE :
                break;
            case self::STOCK_TYPE_INDEX :
                break;
            default :
                throw new \Exception('stock type ' . $type . ' is not supported.');
        }
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    public function getExchangeStr()
    {
        switch ($this->exchange) {
            case self::STOCK_EXCHANGE_SHANGHAI:
                return '上证';
            case self::STOCK_EXCHANGE_SHENZHEN:
                return '深证';
        }
    }

    /**
     * @param $exchange
     * @throws \Exception
     */
    public function setExchange($exchange)
    {
        $exchange = strtoupper($exchange);
        switch ($exchange) {
            case self::STOCK_EXCHANGE_SHANGHAI :
                break;
            case self::STOCK_EXCHANGE_SHENZHEN :
                break;
            default :
                throw new \Exception('exchange is not supported.');
        }
        $this->exchange = $exchange;
    }

    /**
     * @return mixed
     */
    public function getPinyin()
    {
        return $this->pinyin;
    }

    /**
     * @param mixed $pinyin
     */
    public function setPinyin($pinyin)
    {
        $this->pinyin = $pinyin;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusStr()
    {
        switch ($this->getStatus()) {
            case self::STOCK_STATUS_NORMAL:
                return "正常";
            case self::STOCK_STATUS_SUSPENDED:
                return "停牌";
            case self::STOCK_STATUS_TEMPORARY_SUSPENDED:
                return "临时停牌";
            case self::STOCK_STATUS_TEMPORARY_SUSPENDED_1H:
                return "临时停牌1小时";
            case self::STOCK_STATUS_SUSPENDED_HALF:
                return "停牌1/2";
            case self::STOCK_STATUS_HALT:
                return "暂停";
            case self::STOCK_STATUS_UNRECORDED:
                return "无记录";
            case self::STOCK_STATUS_UNLISTED:
                return "未上市";
            case self::STOCK_STATUS_DELISTED:
                return "已退市";
        }
    }

    /**
     * @param mixed $status
     * @throws \Exception
     */
    public function setStatus($status)
    {
        switch ($status) {
            case "00":  //
                $this->status = self::STOCK_STATUS_NORMAL;
                break;
            case "01":  // 临停1H
                $this->status = self::STOCK_STATUS_TEMPORARY_SUSPENDED_1H;
                break;
            case "02":  // 停牌
            case "03":  // 停牌
                $this->status = self::STOCK_STATUS_SUSPENDED;
                break;
            case "04":  // 临停
                $this->status = self::STOCK_STATUS_TEMPORARY_SUSPENDED;
                break;
            case "05":  // 停1/2
                $this->status = self::STOCK_STATUS_SUSPENDED_HALF;
                break;
            case "07":  // 暂停
                $this->status = self::STOCK_STATUS_HALT;
                break;
            case "-1":  // 无记录
                $this->status = self::STOCK_STATUS_UNRECORDED;
                break;
            case "-2":  // 未上市
                $this->status = self::STOCK_STATUS_UNLISTED;
                break;
            case "-3":  // 已退市
                $this->status = self::STOCK_STATUS_DELISTED;
                break;
            default :
                throw new \Exception('status is not supported.');
        }
    }

}