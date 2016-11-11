<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmarkTest;
use fillup\A2X;


class FillupArray2Xml implements IUnitBenchmarkTest
{

	public function execute($data)
	{
		$a2x = new A2X($data);
		$xml = $a2x->asXml();
		return $xml;
	}

}