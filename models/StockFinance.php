<?php
/**
 * 股票财务信息
 *
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/24 0024
 * Time: 10:35
 */

namespace models;

/**
 * Class StockFinance
 * @package models
 * @used-by CrawlerSina::getStockFinance()
 */
class StockFinance
{
    /**
     * @var Stock
     */
    private $stock;
    /**
     * @var string 前一年每股收益/元
     */
    private $lastYearEPS;
    /**
     * @var string 最近四个季度每股收益/元
     */
    private $last4QuarterEPS;
    /**
     * @var string 最近报告的每股净资产/万元
     */
    private $recentNAPS;
    /**
     * @var string 最近年度净利润/万元
     */
    private $lastYearProfit;
    /**
     * @var string 最近四个季度净利润/万元
     */
    private $last4QuarterProfit;
    /**
     * @var string 最近报告的净利润/万元
     */
    private $recentProfit;
    /**
     * @var string 最近报告的营收/万元
     */
    private $recentRevenue;

    /**
     * @param Stock $stock
     */
    public function setStock(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return mixed
     */
    public function getLastYearEPS()
    {
        return $this->lastYearEPS;
    }

    /**
     * @param mixed $lastYearEPS
     */
    public function setLastYearEPS($lastYearEPS)
    {
        $this->lastYearEPS = $lastYearEPS;
    }

    /**
     * @return mixed
     */
    public function getLast4QuarterEPS()
    {
        return $this->last4QuarterEPS;
    }

    /**
     * @param mixed $last4QuarterEPS
     */
    public function setLast4QuarterEPS($last4QuarterEPS)
    {
        $this->last4QuarterEPS = $last4QuarterEPS;
    }

    /**
     * @return mixed
     */
    public function getRecentNAPS()
    {
        return $this->recentNAPS;
    }

    /**
     * @param mixed $recentNAPS
     */
    public function setRecentNAPS($recentNAPS)
    {
        $this->recentNAPS = $recentNAPS;
    }

    /**
     * @return mixed
     */
    public function getLastYearProfit()
    {
        return $this->lastYearProfit;
    }

    /**
     * @param mixed $lastYearProfit
     */
    public function setLastYearProfit($lastYearProfit)
    {
        $this->lastYearProfit = $lastYearProfit;
    }

    /**
     * @return mixed
     */
    public function getLast4QuarterProfit()
    {
        return $this->last4QuarterProfit;
    }

    /**
     * @param mixed $last4QuarterProfit
     */
    public function setLast4QuarterProfit($last4QuarterProfit)
    {
        $this->last4QuarterProfit = $last4QuarterProfit;
    }

    /**
     * @return mixed
     */
    public function getRecentProfit()
    {
        return $this->recentProfit;
    }

    /**
     * @param mixed $recentProfit
     */
    public function setRecentProfit($recentProfit)
    {
        $this->recentProfit = $recentProfit;
    }

    /**
     * @return mixed
     */
    public function getRecentRevenue()
    {
        return $this->recentRevenue;
    }

    /**
     * @param mixed $recentRevenue
     */
    public function setRecentRevenue($recentRevenue)
    {
        $this->recentRevenue = $recentRevenue;
    }

}