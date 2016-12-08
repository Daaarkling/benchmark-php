<?php

namespace Benchmark\Units\Json;


use Benchmark\Converters\JsonConverter;
use Benchmark\Units\AUnitBenchmark;
use Seld\JsonLint\JsonParser;


class SeldJsonlint extends AUnitBenchmark
{

	/** @var  JsonParser */
	private $parser;


	public function prepareBenchmark()
	{
		$this->parser = new JsonParser();
	}


	protected function prepareDataForDecode()
	{
		$jsonConverter = new JsonConverter();
		return $jsonConverter->convertData($this->data);
	}


	public function decode($data)
	{
		$data = $this->parser->parse($data);
	}
}