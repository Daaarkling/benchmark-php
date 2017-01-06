<?php

namespace Benchmark\Metrics\Json;


use Benchmark\Metrics\AMetric;


class PhpJsonFunction extends AMetric
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