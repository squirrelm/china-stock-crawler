<?php
/**
 * 股票股本结构信息
 *
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/24 0024
 * Time: 11:24
 */

namespace models;


/**
 * Class StockStructure
 * @package models
 * @used-by CrawlerSina
 */
class StockStructure
{
    /**
     * @var Stock
     */
    private $stock;
    /**
     * @var string 总股本/万股
     */
    private $totalCapital; 
    /**
     * @var string 流通股本/万股
     */
    private $negotiableCapital;
    /**
     * @var string A股流通股本/万股
     */
    private $negotiableCapitalA;
    /**
     * @var string B股流通股本/万股
     */
    private $negotiableCapitalB;

    /**
     * @return Stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return mixed
     */
    public function getTotalCapital()
    {
        return $this->totalCapital;
    }

    /**
     * @param mixed $totalCapital
     */
    public function setTotalCapital($totalCapital)
    {
        $this->totalCapital = $totalCapital;
    }

    /**
     * @return mixed
     */
    public function getNegotiableCapital()
    {
        return $this->negotiableCapital;
    }

    /**
     * @param mixed $negotiableCapital
     */
    public function setNegotiableCapital($negotiableCapital)
    {
        $this->negotiableCapital = $negotiableCapital;
    }

    /**
     * @return mixed
     */
    public function getNegotiableCapitalA()
    {
        return $this->negotiableCapitalA;
    }

    /**
     * @param mixed $negotiableCapitalA
     */
    public function setNegotiableCapitalA($negotiableCapitalA)
    {
        $this->negotiableCapitalA = $negotiableCapitalA;
    }

    /**
     * @return mixed
     */
    public function getNegotiableCapitalB()
    {
        return $this->negotiableCapitalB;
    }

    /**
     * @param mixed $negotiableCapitalB
     */
    public function setNegotiableCapitalB($negotiableCapitalB)
    {
        $this->negotiableCapitalB = $negotiableCapitalB;
    }

}