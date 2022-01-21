<?php

namespace App\Tests;

use App\Designers\JsonDesigner;
use App\Designers\SerializeDesigner;
use PHPUnit\Framework\TestCase;

class DesignerTest extends TestCase
{
	/**
	 * @return array
	 */
	public function dataProvider()
	{
		return [
			[
				['views' => 123, 'crawlers' => 4,]
			],
		];
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function testJSON($content)
	{
		$designer = new JsonDesigner();
		$data     = $designer->design($content);
		$this->assertJsonStringEqualsJsonString($data, json_encode($content));
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function testSerialization($content)
	{
		$designer = new SerializeDesigner();
		$data     = $designer->design($content);
		$this->assertEquals($data, serialize($content));
	}
}