<?php


namespace Benchmark\Converters\ProtobufPhpProtobuf;



use Benchmark\Converters\IDataConverter;

class ProtobufBinaryConverter extends ProtobufConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		$data = parent::convertData($jsonTestData);
	//	return $data->toStream();
	}


}