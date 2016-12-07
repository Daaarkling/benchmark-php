<?php

namespace Benchmark\Units\Json;


use Benchmark\Units\AUnitBenchmark;
use Webmozart\Json\JsonDecoder;
use Webmozart\Json\JsonEncoder;


class WebmozartJson extends AUnitBenchmark
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