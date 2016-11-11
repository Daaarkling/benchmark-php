<?php

namespace Benchmark\Encoders\Xml;


use Benchmark\IUnitBenchmarkTest;
use LSS\Array2XML;


class OpenlssLibArray2Xml implements IUnitBenchmarkTest
{



	public function execute($data)
	{
		$xml = Array2XML::createXML('root', $data);
		return $xml->saveXML();
	}


}