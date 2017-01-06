<?php

namespace Benchmark\Metrics\Xml;


use Benchmark\Metrics\AMetric;
use LSS\Array2XML;
use LSS\XML2Array;


class OpenlssLibArray2Xml extends AMetric
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