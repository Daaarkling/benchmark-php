<?php

namespace Benchmark\Units\Xml;

use Benchmark\Converters\XmlConverter;
use Benchmark\Units\AUnitBenchmark;
use SimplestXML;


class TraegerSimplestXML extends AUnitBenchmark
{

	/** @var  SimplestXML */
	private $simplestXML;


	public function prepareBenchmark()
	{
		$this->simplestXML = new SimplestXML();
	}

	public function prepareDataForDecode()
	{
		$xmlConverter = new XmlConverter();
		return $xmlConverter->convertData($this->data);
	}

	public function decode($data)
	{
		$data = $this->simplestXML->from_xml($data);
	}


}