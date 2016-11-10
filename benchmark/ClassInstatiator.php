<?php
/**
 * Created by PhpStorm.
 * User: Jan
 * Date: 10. 11. 2016
 * Time: 18:52
 */

namespace Benchmark;


class ClassInstantiator
{
	/**
	 * Create object $className and check type $instanceof
	 *
	 * @param string $className
	 * @param string $instanceof
	 * @return object|NULL
	 */
	public static function instantiateClass($className, $instanceof)
	{
		if (!class_exists($className)) {
			return NULL;
		}
		$class = new $className();
		if (!$class instanceof $instanceof) {
			return NULL;
		}
		return $class;
	}
}