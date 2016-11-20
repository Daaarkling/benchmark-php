<?php


namespace Benchmark;



class BenchmarkDumpOutput extends Benchmark
{

	protected function handleResult($result)
	{
		var_dump($result);
	}
}