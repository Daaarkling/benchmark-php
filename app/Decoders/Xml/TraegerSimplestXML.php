<?php

namespace Benchmark\Decoders\Xml;


use Benchmark\IUnitBenchmark;
use SimplestXML;


class TraegerSimplestXML implements IUnitBenchmark
{

	/** @var  SimplestXML */
	private $simplestXML;


	public function __construct()
	{
		$this->simplestXML = new SimplestXML();
	}

	public function execute($data)
	{
		$data = $this->simplestXML->from_xml($data);
	}


}