<?php

namespace Benchmark\Decoders\Xml;


use Benchmark\IUnitBenchmark;
use LSS\XML2Array;


class OpenlssLibArray2Xml implements IUnitBenchmark
{


	public function execute($data)
	{
		XML2Array::createArray($data);
	}


}