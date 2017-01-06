<?php

namespace Benchmark\Metrics\Json;


use Benchmark\Metrics\AMetric;
use JsonStreamingParser\Listener\InMemoryListener;
use JsonStreamingParser\Parser;


class SalsifyJsonStreamingParser extends AMetric
{

	protected function prepareDataForDecode()
	{
		return '';
	}


	public function decode($data)
	{
		$listener = new InMemoryListener();
		$stream = fopen($this->dataFile, 'r');
		try {
			$parser = new Parser($stream, $listener);
			$start = microtime(TRUE);
			$parser->parse();
			$time = microtime(TRUE) - $start;
			fclose($stream);
			return $time;
		} catch (\Exception $e) {
			fclose($stream);
			return FALSE;
			//throw $e;
		}
	}
}