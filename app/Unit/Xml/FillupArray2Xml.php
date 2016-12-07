<?php

namespace Benchmark\Unit\Xml;


use Benchmark\Unit\AUnitBenchmark;
use fillup\A2X;


class FillupArray2Xml extends AUnitBenchmark
{

	public function encode($data)
	{
		$a2x = new A2X($data);
		$xml = $a2x->asXml();
		return $xml;
	}

}