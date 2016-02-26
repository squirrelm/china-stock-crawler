<?php
/**
 * 股票交易情况
 *
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/24 0024
 * Time: 15:49
 */

namespace models;


class StockTrading
{
    // 涨跌幅限制比率
    const PRICE_LIMIT_RATIO_NORMAL  = 0.1;  // 普通股
    const PRICE_LIMIT_RATIO_ST  = 0.05;  // ST股
    const PRICE_LIMIT_RATIO_NEW  = null;  //TODO 新股

    /**
     * @var Stock
     */
    private $stock;
    /**
     * @var StockFinance
     */
    private $stockFinance;
    /**
     * @var StockStructure
     */
    private $stockStructure;

    private $price; // 当前价位
    private $volume;    // 成交量/股
    private $amount;    // 成交额/元
    private $open;  // 今开盘价
    private $preClose;  // 昨收盘价
    private $high;  // 最高价
    private $low;   // 最低价
    private $date;  // 抓取日期
    private $time;  // 抓取时间


    public function __construct(Stock $stock)
    {
        $this->stock    = $stock;
    }

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param Stock $stock
     */
    public function setStock(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return StockFinance
     */
    public function getStockFinance()
    {
        return $this->stockFinance;
    }

    /**
     * @param StockFinance $stockFinance
     */
    public function setStockFinance(StockFinance $stockFinance)
    {
        $this->stockFinance = $stockFinance;
    }

    /**
     * @return StockStructure
     */
    public function getStockStructure()
    {
        return $this->stockStructure;
    }

    /**
     * @param StockStructure $stockStructure
     */
    public function setStockStructure(StockStructure $stockStructure)
    {
        $this->stockStructure = $stockStructure;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param mixed $volume
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * @param mixed $open
     */
    public function setOpen($open)
    {
        $this->open = $open;
    }

    /**
     * @return mixed
     */
    public function getPreClose()
    {
        return $this->preClose;
    }

    /**
     * @param mixed $preClose
     */
    public function setPreClose($preClose)
    {
        $this->preClose = $preClose;
    }

    /**
     * @return mixed
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * @param mixed $high
     */
    public function setHigh($high)
    {
        $this->high = $high;
    }

    /**
     * @return mixed
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * @param mixed $low
     */
    public function setLow($low)
    {
        $this->low = $low;
    }

    /**
     * @return mixed
     */
    public function getUpLimit()
    {
        return (1 + $this->getPriceLimitRatio()) * $this->getPreClose();
    }

    /**
     * @return mixed
     */
    public function getDownLimit()
    {
        return (1 - $this->getPriceLimitRatio()) * $this->getPreClose();
    }

    /**
     * @return mixed
     */
    public function getChange()
    {
        return $this->getPrice() - $this->getPreClose();
    }

    /**
     * 涨跌幅
     * @return mixed
     */
    public function getChangePer()
    {
        return ($this->getChange() / $this->getPreClose()) * 100;
    }

    /**
     * 换手率
     * @return mixed
     */
    public function getTurnoverRatio()
    {
        return $this->getVolume() / ($this->stockStructure->getNegotiableCapital() * 10000) * 100;
    }

    /**
     * 振幅(%)
     * @return mixed
     */
    public function getSwingPer()
    {
        return (($this->getHigh() - $this->getLow()) / $this->getPreClose()) * 100;
    }

    /**
     * 总市值/万元
     * @return mixed
     */
    public function getTmc()
    {
        return $this->getPrice() * $this->stockStructure->getTotalCapital();
    }

    /**
     * 流通市值/万元
     * @return mixed
     */
    public function getNmc()
    {
        return $this->getPrice() * $this->stockStructure->getNegotiableCapital();
    }

    /**
     * 市盈率(TTM)
     * @return mixed
     */
    public function getPeTtm()
    {
        return $this->getTmc() / $this->stockFinance->getLast4QuarterProfit();
    }

    /**
     * 市净率
     * @return mixed
     */
    public function getPb()
    {
        return $this->getPrice() / $this->stockFinance->getRecentNAPS();
    }

    /**
     * @return mixed
     */
    public function getPriceLimitRatio()
    {
        if ($this->stock->isST()) {
            return self::PRICE_LIMIT_RATIO_ST;
        } else {
            return self::PRICE_LIMIT_RATIO_NORMAL;
        }
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

}