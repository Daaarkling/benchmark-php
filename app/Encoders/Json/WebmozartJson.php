<?php

namespace Benchmark\Encoders\Json;


use Benchmark\IUnitBenchmark;
use Webmozart\Json\JsonEncoder;


class WebmozartJson implements IUnitBenchmark
{

	/** @var JsonEncoder */
	private $encoder;


	public function __construct()
	{
		$this->encoder = new JsonEncoder();
	}

	public function execute($data)
	{
		return $this->encoder->encode($data);
	}
}