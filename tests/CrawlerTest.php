<?php

namespace tests;

use models\Crawler;

/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/3/3 0003
 * Time: 10:07
 */

class CrawlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Crawler
     */
    private $crawler;

    public function setUp()
    {
        $this->crawler = new Crawler();
    }

    public function testFetchSuccess()
    {
        $url = "http://www.sina.com.cn/";
        $data = $this->crawler->fetch($url);
        $pos = strpos($data, '<html');
        $this->assertNotEquals(false, $pos);
    }

    /**
     * @expectedException \Exception
     */
    public function testFetchError()
    {
        $url = "http://aa.bb.cc/";
        $this->crawler->fetch($url);
    }
}