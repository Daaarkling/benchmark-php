<?php

namespace Benchmark\Decoders\Protobuf;


use Benchmark\Converters\GoogleProtobuf\PersonCollection;
use Benchmark\IUnitBenchmark;

class GoogleProtobuf implements IUnitBenchmark
{
	/** @var  PersonCollection */
	private $personCollection;

	/**
	 * GoogleProtobuf constructor.
	 */
	public function __construct()
	{
		$this->personCollection = new PersonCollection();
	}

	public function execute($data)
	{
		$this->personCollection->decode($data);
	}
}