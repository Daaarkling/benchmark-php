<?php
/**
 * @author      Jan Vaňura <jano.vano@gmail.com>
 * @package     Benchmark
 */


namespace Benchmark\Decoders;


use Benchmark\IDataConverter;
use Nette\Utils\Json;

class SerializeConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		$array = Json::decode($jsonTestData, Json::FORCE_ARRAY);
		return serialize($array);
	}


}