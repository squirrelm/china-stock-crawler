<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2015/7/8
 * Time: 11:26
 */

namespace models;

/**
 * Class CrawlerSina
 * @package models
 */
class CrawlerSina
{
    const API_URL_STOCK_DATA = "http://hq.sinajs.cn/list=%s";

    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * CrawlerSina constructor.
     * @param Crawler $crawler
     */
    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @param string $symbol
     * @return StockTrading
     * @throws CrawlerException
     * @throws \Exception
     */
    public function getStockTradingData($symbol)
    {
        $url = str_replace('%s', "{$symbol},{$symbol}_i", self::API_URL_STOCK_DATA);
        $data = $this->crawler->fetch($url, [], Crawler::METHOD_GET);

        $data = mb_convert_encoding($data, 'UTF-8', 'GB2312');

        $lines = explode(chr(0x0a), $data);
        $arr_str1 = explode('"', $lines[0]);
        $arr_str2 = explode('"', $lines[1]);

        if (empty($arr_str1[1])) {
            throw new CrawlerException('未取到行情数据');
        }
        if (empty($arr_str2[1])) {
            throw new CrawlerException('未取到近期数据');
        }

        $arr_quote = explode(',', $arr_str1[1]);
        $arr_recent = explode(',', $arr_str2[1]);

        $stock = $this->getStock($symbol, $arr_quote, $arr_recent);
        $stockFinance = $this->getStockFinance($arr_recent);
        $stockStructure = $this->getStockStructure($arr_recent);
        $stockTrading = $this->getStockTrading($stock, $stockFinance, $stockStructure, $arr_quote);

        return $stockTrading;
    }

    /**
     * @param string $symbol
     * @param array $arr_quote
     * @param array $arr_recent
     * @return Stock
     * @throws \Exception
     */
    private function getStock($symbol, $arr_quote, $arr_recent)
    {
        $code = substr($symbol, 2);
        $exchange = substr($symbol, 0, 2);

        $stock = new Stock();
        $stock->setCode($code);
        $stock->setSymbol($symbol);
        $stock->setExchange($exchange);
        $stock->setName($arr_quote[0]);
        $stock->setPinyin($arr_recent[1]);
        $stock->setType($arr_recent[0]);
        $stock->setStatus($arr_quote[32]);

        return $stock;
    }

    /**
     * @param array $arr_recent
     * @return StockFinance
     * @uses StockFinance
     */
    private function getStockFinance($arr_recent)
    {
        $stockFinance = new StockFinance();
        $stockFinance->setLast4QuarterEPS($arr_recent[3]);
        $stockFinance->setLastYearEPS($arr_recent[2]);
        $stockFinance->setLast4QuarterProfit($arr_recent[13] * 10000);
        $stockFinance->setLastYearProfit($arr_recent[12] * 10000);
        $stockFinance->setRecentNAPS($arr_recent[5]);
        $stockFinance->setRecentProfit($arr_recent[18] * 10000);
        $stockFinance->setRecentRevenue($arr_recent[17] * 10000);

        return $stockFinance;
    }

    /**
     * @param array $arr_recent
     * @return StockStructure
     * @uses StockStructure
     */
    private function getStockStructure($arr_recent)
    {
        $stockStructure = new StockStructure();
        $stockStructure->setNegotiableCapital($arr_recent[8]);
        $stockStructure->setNegotiableCapitalA($arr_recent[9]);
        $stockStructure->setNegotiableCapitalB($arr_recent[10]);
        $stockStructure->setTotalCapital($arr_recent[7]);

        return $stockStructure;
    }

    /**
     * @param Stock $stock
     * @param StockFinance $stockFinance
     * @param StockStructure $stockStructure
     * @param array $arr_quote
     * @return StockTrading
     */
    private function getStockTrading(
        Stock $stock,
        StockFinance $stockFinance,
        StockStructure $stockStructure,
        Array $arr_quote
    ) {
        $stockTrading = new StockTrading($stock);
        $stockTrading->setStockFinance($stockFinance);
        $stockTrading->setStockStructure($stockStructure);
        $stockTrading->setPrice($arr_quote[3]);
        $stockTrading->setVolume($arr_quote[8]);
        $stockTrading->setAmount($arr_quote[9]);
        $stockTrading->setHigh($arr_quote[4]);
        $stockTrading->setLow($arr_quote[5]);
        $stockTrading->setPreClose($arr_quote[2]);
        $stockTrading->setOpen($arr_quote[1]);
        $stockTrading->setDate($arr_quote[30]);
        $stockTrading->setTime($arr_quote[31]);

        return $stockTrading;
    }

}