<?php

namespace Darkling\Benchmark\Encoders\Json;


use Darkling\Benchmark\IUnitBenchmark;
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