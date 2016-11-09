<?php


namespace Benchmark;



class BenchmarkTableOutput extends Benchmark
{


	protected function handleResult($result)
	{
		var_dump($result);
		exit;
	}
}