<?php

namespace AppTest\Unit\Di;

use App\Di\Resolver;
use AppTest\Helpers\TestHelper;

class ResolverTest extends \PHPUnit\Framework\TestCase {
	/**
	 * @test
	 * @dataProvider resolveData
	 */
	public function resolve(string $class, array $methods, string $expected) {
		$this->assertInstanceOf($expected, Resolver::resolve($class, $methods));
	}

	public function resolveData(): array {
		return [
			[
				\DateTime::class,
				[
					'__construct' => [date('Y-m-d')],
					'diff'        => [new \DateTime],
				],
				\DateTime::class,
			],
		];
	}

	/**
	 * @test
	 * @dataProvider createData
	 */
	public function create(string $class, array $args) {
		$this->assertInstanceOf($class, TestHelper::invokeStaticMethod(Resolver::class, 'create', [$class, $args]));
	}

	public function createData(): array {
		return [
			[\DateTime::class,                       []],
			[\DateTime::class,                       [date('Y-m-d')]],
			[\Phalcon\Mvc\View::class,               []],
			[\App\Plugins\ExceptionForwarder::class, []],
		];
	}

	/**
	 * @test
	 * @dataProvider createExceptionData
	 * @expectedException \App\Exception\Runtime
	 */
	public function createException(string $class, array $args) {
		TestHelper::invokeStaticMethod(Resolver::class, 'create', [$class, $args]);
	}

	public function createExceptionData(): array {
		return [
			['',              []],
			['undefindClass', []],
		];
	}

	/**
	 * @test
	 * @dataProvider invokeData
	 */
	public function invoke($instance, string $method, array $args) {
		TestHelper::invokeStaticMethod(Resolver::class, 'invoke', [$instance, $method, $args]);
		$this->assertTrue(true);
	}

	public function invokeData(): array {
		return [
			[new \DateTime,         'diff',        [new \DateTime]],
			[new \Phalcon\Mvc\View, 'setViewsDir', [APP_DIR . '/views']],
		];
	}

	/**
	 * @test
	 * @dataProvider invokeExceptionData
	 * @expectedException \App\Exception\Runtime
	 */
	public function invokeException($instance, string $method, array $args) {
		TestHelper::invokeStaticMethod(Resolver::class, 'invoke', [$instance, $method, $args]);
	}

	public function invokeExceptionData(): array {
		return [
			[new \DateTime, '',                []],
			[new \DateTime, 'undefinedMethod', []],
		];
	}
}
