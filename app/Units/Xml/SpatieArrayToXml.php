<?php

namespace Benchmark\Units\Xml;

use Benchmark\Units\AUnitBenchmark;
use Spatie\ArrayToXml\ArrayToXml;


class SpatieArrayToXml extends AUnitBenchmark
{

	public function encode($data)
	{
		$xml = ArrayToXml::convert($data);
		return $xml;
	}

}