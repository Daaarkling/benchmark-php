<?php

namespace Benchmark\Encoders\Avro;


use AvroDataIOReader;
use AvroIODatumReader;
use AvroStringIO;
use Benchmark\IUnitBenchmark;


class AvroOfficial implements IUnitBenchmark
{
	public function execute($data)
	{
		$io = new \AvroStringIO();

		$schema = file_get_contents(__DIR__ . '/../../Convertors/Avro/avro_schema.json');

		$writerSchema = \AvroSchema::parse($schema);
		$writer = new \AvroIODatumWriter($writerSchema);
		$dataWriter = new \AvroDataIOWriter($io, $writer, $writerSchema);

		$dataWriter->append($data);
		$dataWriter->close();
		return $io->string();
	}

}