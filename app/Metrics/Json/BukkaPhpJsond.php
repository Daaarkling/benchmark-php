<?php

namespace Benchmark\Metrics\Json;


use Benchmark\Metrics\AMetric;


class BukkaPhpJsond extends AMetric
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