<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2016/2/24 0024
 * Time: 19:20
 */
use models\Crawler;
use models\CrawlerSina;
use models\CrawlerException;
use helps\Cli;

require '_bootstrap.php';

if (!isset($argv[1])) {
    throw new CrawlerException('错误。请输入一个股票标志，例如：sh601998');
}
$symbol = $argv[1];
$symbol = strtolower($symbol);
if (!preg_match('/^s(h|z)\d{6}$/', $symbol)) {
    throw new CrawlerException('错误。股票标志格式不正确，请重新输入，例如：sh601998');
}

$crawlerSina = new CrawlerSina(new Crawler());
$stockTrading = $crawlerSina->getStockTradingData($symbol);
$stock = $stockTrading->getStock();
$stockStructure = $stockTrading->getStockStructure();
$stockFinance = $stockTrading->getStockFinance();
// 基本信息
$code = $stock->getCode();
$name = $stock->getName();
$exchangeStr = $stock->getExchangeStr();
$pinyin = $stock->getPinyin();
$statusStr = $stock->getStatusStr();
$typeStr = $stock->getTypeStr();
// 股本结构
$totalCapital = number_format($stockStructure->getTotalCapital(), 2);
$negotiableCapital = number_format($stockStructure->getNegotiableCapital(), 2);
$negotiableCapitalA = number_format($stockStructure->getNegotiableCapitalA(), 2);
$negotiableCapitalB = number_format($stockStructure->getNegotiableCapitalB(), 2);
// 财务状况
$lastYearEPS = number_format($stockFinance->getLastYearEPS(), 2);
$last4QuarterEPS = number_format($stockFinance->getLast4QuarterEPS(), 2);
$recentNAPS = number_format($stockFinance->getRecentNAPS(), 2);
$lastYearProfit = number_format($stockFinance->getLastYearProfit(), 2);
$last4QuarterProfit = number_format($stockFinance->getLast4QuarterProfit(), 2);
$recentProfit = number_format($stockFinance->getRecentProfit(), 2);
$recentRevenue = number_format($stockFinance->getRecentRevenue(), 2);
// 交易情况
$price = number_format($stockTrading->getPrice(), 2);
$change = number_format($stockTrading->getChange(), 2);
$changePer = number_format($stockTrading->getChangePer(), 2);
$swingPer = number_format($stockTrading->getSwingPer(), 2);
$upLimit = number_format($stockTrading->getUpLimit(), 2);
$downLimit = number_format($stockTrading->getDownLimit(), 2);
$open = number_format($stockTrading->getOpen(), 2);
$high = number_format($stockTrading->getHigh(), 2);
$low = number_format($stockTrading->getLow(), 2);
$preClose = number_format($stockTrading->getPreClose(), 2);
$volume = number_format($stockTrading->getVolume());
$amount = number_format($stockTrading->getAmount() / 10000, 2);
$tmc = number_format($stockTrading->getTmc() / 10000, 2);
$nmc = number_format($stockTrading->getNmc() / 10000, 2);
$turnover = number_format($stockTrading->getTurnoverRatio(), 2);
$pe = number_format($stockTrading->getPeTtm(), 2);
$pb = number_format($stockTrading->getPb(), 2);
$date = $stockTrading->getDate();
$time = $stockTrading->getTime();


$out = <<<CMD
============================================
基本数据
--------------------------------------------
名称: {$name}
代码: {$code}
证交所: {$exchangeStr}
类型: {$typeStr}
简写: {$pinyin}
状态: {$statusStr}
============================================
股本结构
--------------------------------------------
总股本(万股): {$totalCapital}
流通股本(万股): {$negotiableCapital}
A股流通股本(万股): {$negotiableCapitalA}
B股流通股本(万股): {$negotiableCapitalB}
============================================
财务状况
--------------------------------------------
前一年每股收益(元): {$lastYearEPS}
最近四个季度每股收益(元): {$last4QuarterEPS}
最近报告的每股净资产(万元): {$recentNAPS}
最近年度净利润(万元): {$lastYearProfit}
最近四个季度净利润(万元): {$last4QuarterProfit}
最近报告的净利润(万元): {$recentProfit}
最近报告的营收(万元): {$recentRevenue}
============================================
交易行情
--------------------------------------------
当前价: {$price}
涨跌额: {$change}
涨跌幅: {$changePer}%
涨停价: {$upLimit}
跌停价: {$downLimit}
今开价: {$open}
昨收价: {$preClose}
成交量(股): {$volume}
振幅: {$swingPer}%
最高: {$high}
成交额(万元): {$amount}
换手率: {$turnover}%
最低: {$low}
总市值(亿元): {$tmc}
市净率: {$pb}
流通市值(亿元): {$nmc}
市盈率ttm: {$pe}
日期: {$date}
时间: {$time}
============================================

CMD;

Cli::output($out);

exit(0);