<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmark;
use Spatie\ArrayToXml\ArrayToXml;


class SpatieArrayToXml implements IUnitBenchmark
{

	public function execute($data)
	{
		$xml = ArrayToXml::convert($data);
		return $xml;
	}

}