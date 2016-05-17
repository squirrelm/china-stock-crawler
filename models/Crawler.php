<?php
/**
 * Created by PhpStorm.
 * User: squirrelm
 * Date: 2015/7/7
 * Time: 17:05
 */
namespace models;

/**
 * Class Crawler
 * @package models
 */
class Crawler
{

	const METHOD_GET	= 'get';
	const METHOD_POST	= 'post';

	const MULTI_FETCH_INTERVAL = 100000;

    /**
     * @param string $url
     * @param array $param
     * @param string $method
     * @return string|false
     * @throws \Exception
     */
	public function fetch($url, Array $param = [], $method = self::METHOD_GET) {
		$ch = curl_init();
		if(strtolower($method) === self::METHOD_GET){
			if (!empty($param)) {
				$param_str	= urldecode(http_build_query($param));
				$url = $url . "?" . $param_str;
			}
		}else{
			curl_setopt($ch, CURLOPT_POST, 1);
			if (!empty($param)) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			}
		}

		$headers = $this->_setHeaders();
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");

		$data	= curl_exec($ch);

		if(curl_errno($ch)) {
			throw new \Exception("Spider fetch error: " . curl_error($ch));
		}

		curl_close($ch);

		return $data;
	}

    /**
     * @param array $urls
     * @param array $param
     * @param string $method
     * @return string[]
     */
	public function multiFetch(Array $urls, Array $param, $method = self::METHOD_GET) {
		$mh = curl_multi_init();
		$handles = array();
		foreach($urls as $key => $url){
			$ch = curl_init();
			if(strtolower($method) === self::METHOD_GET){
				if (!empty($param)) {
					$param_str	= urldecode(http_build_query($param));
					$url = $url . "?" . $param_str;
				}
			}else{
				curl_setopt($ch, CURLOPT_POST, 1);
				if (!empty($param)) {
					curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
				}
			}

			$headers = $this->_setHeaders();
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip");
			curl_multi_add_handle($mh, $ch);
			$handles[(int)$ch] = $key;
		}

		$running = null;
		$data = array();
		do {
			usleep(self::MULTI_FETCH_INTERVAL);
			curl_multi_exec($mh, $running);
			while( ( $ret = curl_multi_info_read( $mh ) ) !== false ){
				$data[$handles[(int)$ret["handle"]]] = $ret;
			}
		} while ( $running > 0 );

		$ret = [];
		foreach($data as $key => $val){
			$ret[$key] 	= curl_multi_getcontent($val["handle"]);
			curl_multi_remove_handle($mh, $val["handle"]);
		}
		curl_multi_close($mh);
		ksort($ret);

		return $ret;
	}

	private function _setHeaders() {
		return [
			"Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
			"Cache-Control:no-cache",
			"Accept-Encoding:gzip,deflate,sdch",
			"Accept-Language:zh-CN,zh;q=0.8",
			"User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.130 Safari/537.36",
		];
	}

}