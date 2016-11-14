<?php

namespace Darkling\Benchmark\Encoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use Spatie\ArrayToXml\ArrayToXml;


class SpatieArrayToXml implements IUnitBenchmark
{

	public function execute($data)
	{
		$xml = ArrayToXml::convert($data);
		return $xml;
	}

}