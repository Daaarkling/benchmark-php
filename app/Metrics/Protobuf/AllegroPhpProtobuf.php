<?php

namespace Benchmark\Metrics\Protobuf;


use Benchmark\Converters\AllegroPhpProtobuf\PersonCollection;
use Benchmark\Converters\AllegroPhpProtobuf\ProtobufConverter;
use Benchmark\Metrics\AMetric;


class AllegroPhpProtobuf extends AMetric
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
		return $data->serializeToString();
	}


	public function decode($data)
	{
		try {
			$this->personCollection->parseFromString($data);
		} catch (\Exception $ex){
			return FALSE;		
		}		
	}
}
