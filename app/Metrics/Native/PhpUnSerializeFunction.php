<?php

namespace Benchmark\Metrics\Native;



use Benchmark\Metrics\AMetric;

class PhpUnSerializeFunction extends AMetric
{

	public function encode($data)
	{
		return serialize($data);
	}

	public function decode($data)
	{
		unserialize($data);
	}
}