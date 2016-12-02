<?php

namespace Benchmark\Encoders\Avro;


use AvroDataIOReader;
use AvroIODatumReader;
use AvroStringIO;
use Benchmark\IUnitBenchmark;


class AvroOfficial implements IUnitBenchmark
{

	/** @var  \AvroStringIO */
	private $io;

	/** @var \AvroSchema  */
	private $writerSchema;

	/** @var \AvroIODatumWriter  */
	private $writer;


	public function __construct()
	{
		$schema = file_get_contents(__DIR__ . '/../../Convertors/Avro/avro_schema.json');
		$this->writerSchema = \AvroSchema::parse($schema);
		$this->writer = new \AvroIODatumWriter($this->writerSchema);
	}



	public function execute($data)
	{
		$io = new \AvroStringIO();
		$dataWriter = new \AvroDataIOWriter($io, $this->writer, $this->writerSchema);
		$dataWriter->append($data);
		$dataWriter->close();
		return $io->string();
	}

}