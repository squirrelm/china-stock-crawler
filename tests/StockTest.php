<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/3/3 0003
 * Time: 15:47
 */

namespace tests;

use models\Crawler;
use models\CrawlerSina;
use models\Stock;

class StockTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CrawlerSina
     */
    private $crawlerSina;

    public function setUp()
    {
        $this->crawlerSina = new CrawlerSina(new Crawler());
    }

    public function testStockTypeAShare()
    {
        $data = $this->crawlerSina->getStockTradingData('sh601998');
        $this->assertEquals(Stock::STOCK_TYPE_A_SHARE, $data->getStock()->getType());
    }

    public function testStockTypeBShare()
    {
        $data = $this->crawlerSina->getStockTradingData('sh900922');
        $this->assertEquals(Stock::STOCK_TYPE_B_SHARE, $data->getStock()->getType());
    }

    public function testStockTypeIndex()
    {
        $data = $this->crawlerSina->getStockTradingData('sh000001');
        $this->assertEquals(Stock::STOCK_TYPE_INDEX, $data->getStock()->getType());
    }

    public function testStockExchangeSh()
    {
        $data = $this->crawlerSina->getStockTradingData('sh601998');
        $this->assertEquals(Stock::STOCK_EXCHANGE_SHANGHAI, $data->getStock()->getExchange());
    }

    public function testStockExchangeSz()
    {
        $data = $this->crawlerSina->getStockTradingData('sz000541');
        $this->assertEquals(Stock::STOCK_EXCHANGE_SHENZHEN, $data->getStock()->getExchange());
    }
}