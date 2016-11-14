<?php


namespace Darkling\Benchmark\Utils;


class Formaters
{


	/**
	 * @link https://latte.nette.org/cs/filters#toc-bytes
	 *
	 * Converts to human readable file size.
	 * @param  int
	 * @param  int
	 * @return string
	 */
	public static function bytes($bytes, $precision = 2)
	{
		$bytes = round($bytes);
		$units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
		foreach ($units as $unit) {
			if (abs($bytes) < 1024 || $unit === end($units)) {
				break;
			}
			$bytes = $bytes / 1024;
		}
		return round($bytes, $precision) . ' ' . $unit;
	}


	/**
	 * Converts microseconds to milliseconds
	 * @param  float $microseconds
	 * @param  int $precision
	 * @return string
	 */
	public static function milliseconds($microseconds, $precision = 4)
	{
		return round(1000 * $microseconds, $precision) . ' ms';
	}
}