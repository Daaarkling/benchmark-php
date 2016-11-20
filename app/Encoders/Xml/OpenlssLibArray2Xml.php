<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmark;
use LSS\Array2XML;


class OpenlssLibArray2Xml implements IUnitBenchmark
{



	public function execute($data)
	{
		$xml = Array2XML::createXML('root', $data);
		return $xml->saveXML();
	}


}