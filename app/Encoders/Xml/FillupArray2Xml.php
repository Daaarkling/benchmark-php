<?php

namespace Darkling\Benchmark\Encoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use fillup\A2X;


class FillupArray2Xml implements IUnitBenchmark
{

	public function execute($data)
	{
		$a2x = new A2X($data);
		$xml = $a2x->asXml();
		return $xml;
	}

}