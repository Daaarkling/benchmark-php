<?php

namespace Benchmark\Unit\Xml;

use Benchmark\Converters\XmlConverter;
use Benchmark\Unit\AUnitBenchmark;
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