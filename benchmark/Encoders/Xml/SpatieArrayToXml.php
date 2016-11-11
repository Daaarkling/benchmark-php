<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmarkTest;
use Spatie\ArrayToXml\ArrayToXml;


class SpatieArrayToXml implements IUnitBenchmarkTest
{

	public function execute($data)
	{
		$xml = ArrayToXml::convert($data);
		return $xml;
	}

}