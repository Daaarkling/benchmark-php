<?php

namespace Benchmark\Units\Protobuf;


use Benchmark\Converters\GoogleProtobuf\PersonCollection;
use Benchmark\Converters\GoogleProtobuf\ProtobufConverter;
use Benchmark\Units\AUnitBenchmark;


class GoogleProtobuf extends AUnitBenchmark
{
	/** @var  PersonCollection */
	private $personCollection;

	/**
	 * GoogleProtobuf constructor.
	 */
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