<?php

namespace Benchmark\Metrics\Json;


use Benchmark\Metrics\AMetric;
use Webmozart\Json\JsonDecoder;
use Webmozart\Json\JsonEncoder;


class WebmozartJson extends AMetric
{

	/** @var JsonDecoder */
	private $decoder;

	/** @var JsonEncoder */
	private $encoder;


	public function prepareBenchmark()
	{
		$this->decoder = new JsonDecoder();
		$this->encoder = new JsonEncoder();
	}


	public function encode($data)
	{
		return $this->encoder->encode($data);
	}

	public function decode($data)
	{
		$this->decoder->decode($data);
	}
}