<?php

namespace Benchmark\Metrics\Protobuf;


use Benchmark\Converters\GoogleProtobuf\PersonCollection;
use Benchmark\Converters\GoogleProtobuf\ProtobufConverter;
use Benchmark\Metrics\AMetric;


class GoogleProtobuf extends AMetric
{
	/** @var  PersonCollection */
	private $personCollection;


	public function prepareBenchmark()
	{
		$this->personCollection = new PersonCollection();
	}

	protected function prepareDataForEncode()
	{
		$converter = new ProtobufConverter();
		return $converter->convertData($this->data);
	}


	public function encode($data)
	{
		return $data->encode();
	}


	public function decode($data)
	{
		$this->personCollection->decode($data);
	}
}