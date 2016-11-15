<?php

namespace Darkling\Benchmark\Decoders\Xml;


use Darkling\Benchmark\IUnitBenchmark;
use LSS\XML2Array;


class OpenlssLibArray2Xml implements IUnitBenchmark
{


	public function execute($data)
	{
		XML2Array::createArray($data);
	}


}