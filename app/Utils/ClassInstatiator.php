<?php

namespace Darkling\Benchmark\Utils;


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