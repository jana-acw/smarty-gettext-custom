<?php

require_once dirname(__FILE__) . '/../block.t.php';

class TestTranslate extends PHPUnit_Framework_TestCase {

	/**
	 * @dataProvider testData
	 * @test
	 */
	public function translateTest($exp, $input, $params) {
		$res = $this->t($input, $params);
		$this->assertEquals($exp, $res);
	}

	/**
	 * @param string $text
	 * @param array $params
	 * @return string
	 */
	private function t($text, $params) {
		return smarty_block_t($params, $text);
	}

	public function testData() {
		// string $expected, string $input, array $params
		return array(
			array('tere tali', 'tere %1', array('1' => 'tali')),

			// various escapes
			array('kommivabrik &quot;kalev&quot;', 'kommivabrik "kalev"', array()),
			array('kommivabrik &quot;kalev&quot;', 'kommivabrik "kalev"', array('escape' => 'html')),
			array("kommivabrik \'kalev\'", "kommivabrik 'kalev'", array('escape' => 'js')),
			array('kommivabrik "kalev"', 'kommivabrik "kalev"', array('escape' => 'js')),
			array('kommivabrik+%22kalev%22', 'kommivabrik "kalev"', array('escape' => 'url')),
			array("kommivabrik+%27kalev%27", "kommivabrik 'kalev'", array('escape' => 'url')),
		);
	}
}