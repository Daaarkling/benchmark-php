<?php


namespace Darkling\Benchmark\Converters;

use Nette\Utils\Json;

class SerializeConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		$array = Json::decode($jsonTestData, Json::FORCE_ARRAY);
		return serialize($array);
	}


}