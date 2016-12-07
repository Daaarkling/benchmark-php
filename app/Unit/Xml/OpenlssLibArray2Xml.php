<?php

namespace Benchmark\Unit\Xml;


use Benchmark\Unit\AUnitBenchmark;
use LSS\Array2XML;
use LSS\XML2Array;


class OpenlssLibArray2Xml extends AUnitBenchmark
{

	public function encode($data)
	{
		$xml = Array2XML::createXML('root', $data);
		return $xml->saveXML();
	}


	public function decode($data)
	{
		XML2Array::createArray($data);
	}


}