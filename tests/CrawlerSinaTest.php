<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/3/3 0003
 * Time: 15:37
 */

namespace tests;

use models\CrawlerSina;
use models\Crawler;

class CrawlerSinaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CrawlerSina
     */
    private $crawlerSina;

    public function setUp()
    {
        $this->crawlerSina = new CrawlerSina(new Crawler());
    }

    /**
     * @expectedException \models\CrawlerException
     */
    public function testNotExistsStock()
    {
        $symbol = 'sh000000';
        $this->crawlerSina->getStockTradingData($symbol);
    }
}