<?php

namespace App\Tests;

use App\Exceptions\InvalidFormatException;
use App\Parsers\AccessLogParser;
use App\Utils\Random;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
	/**
	 * @var string
	 */
	private $tempname;

	/**
	 * @return array
	 */
	public function correctAccessLogDataProvider()
	{
		return [
			['77.21.132.156 - - [24/May/2013:23:38:03 +0200] "POST /app/engine/api.php HTTP/1.1" 200 80 "http://lag.ru/index.php" "Mozilla/5.0 (Windows NT 6.1; WOW64) Googlebot/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31"'],
			['77.21.132.156 - - [24/May/2013:23:37:58 +0200] "-" 400 0 "-" "-"'],
			['77.21.132.156 - - [24/May/2013:23:38:23 +0200] "POST /app/modules/randomgallery.php HTTP/1.1" 200 46542 "http://lag.ru/index.php" "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31"'],
		];
	}

	/**
	 * @return array
	 */
	public function incorrectAccessLogDataProvider()
	{
		return [
			['77.21.132.156 - - [24/May/2013:23:37:58 +0200] "-" - 400 0 "-" "-"']
		];
	}

	/**
	 * @dataProvider correctAccessLogDataProvider
	 */
	public function testSuccessfulAccessLogParser($line)
	{
		$handle = $this->saveDataAndGetHandle($line);
		$parser = new AccessLogParser();
		$data   = $parser->parse($handle);

		$this->assertIsArray($data);
		$this->assertArrayHasKey('views', $data);
		$this->assertArrayHasKey('urls', $data);
		$this->assertArrayHasKey('traffic', $data);
		$this->assertArrayHasKey('crawlers', $data);
		$this->assertArrayHasKey('statusCodes', $data);

		$this->assertSame(1, $data['views']);
		$this->assertSame(4, count($data['crawlers']));
	}

	/**
	 * @dataProvider incorrectAccessLogDataProvider
	 */
	public function testFailureAccessLogParser($line)
	{
		$handle = $this->saveDataAndGetHandle($line);
		$parser = new AccessLogParser();

		try {
			$parser->parse($handle);
		} catch(InvalidFormatException $e) {
			$this->assertTrue(true);
		}
	}

	/**
	 * @param string $line
	 *
	 * @return resource
	 */
	private function saveDataAndGetHandle(string $line)
	{
		$this->tempname = 'tmp/' . Random::getName() . 'txt';
		// $this->tempname = tempnam('tmp/', 'test');
		$handle         = fopen($this->tempname, 'w');
		fwrite($handle, $line);
		fclose($handle);

		$handle = fopen($this->tempname, 'r');

		return $handle;
	}
}