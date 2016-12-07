<?php

namespace Benchmark\Unit\Xml;

use Benchmark\Unit\AUnitBenchmark;
use Spatie\ArrayToXml\ArrayToXml;


class SpatieArrayToXml extends AUnitBenchmark
{

	public function encode($data)
	{
		$xml = ArrayToXml::convert($data);
		return $xml;
	}

}