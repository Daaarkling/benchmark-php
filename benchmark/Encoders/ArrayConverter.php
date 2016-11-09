<?php
/**
 * @author      Jan Vaňura <jano.vano@gmail.com>
 * @package     Benchmark
 */


namespace Benchmark\Encoders;


use Benchmark\IDataConverter;
use Nette\Utils\Json;

class ArrayConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		//return json_decode($jsonTestData);
		return Json::decode($jsonTestData, Json::FORCE_ARRAY);
	}


}