<?php

namespace Benchmark\Units\Json;


use Benchmark\Units\AUnitBenchmark;


class PhpJsonFunction extends AUnitBenchmark
{

	public function encode($data)
	{
		return json_encode($data);
	}

	public function decode($data)
	{
		json_decode($data);
	}
}