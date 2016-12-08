<?php

namespace Benchmark\Units\Json;


use Benchmark\Units\AUnitBenchmark;


class BukkaPhpJsond extends AUnitBenchmark
{

	public function encode($data)
	{
		return jsond_encode($data);
	}

	public function decode($data)
	{
		$data = jsond_decode($data);
	}
}