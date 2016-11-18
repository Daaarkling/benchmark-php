<?php

namespace Darkling\Benchmark\Decoders\Json;


use Darkling\Benchmark\IUnitBenchmark;
use Webmozart\Json\JsonDecoder;


class WebmozartJson implements IUnitBenchmark
{

	/** @var JsonDecoder */
	private $decoder;


	public function __construct()
	{
		$this->decoder = new JsonDecoder();
	}

	public function execute($data)
	{
		$this->decoder->decode($data);
	}
}