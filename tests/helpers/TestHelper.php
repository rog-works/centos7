<?php

namespace AppTest\Helpers;

class TestHelper {
	/**
	 * プライベートメソッドを呼び出し、結果を取得する
	 *
	 * @param mixed  $obj    クラスインスタンス
	 * @param string $method メソッド名
	 * @param array  $args   引数リスト
	 * @return mixed メソッドの返却値
	 */
	public static function invokeMethod($obj, string $method, array $args) {
		$reflect = new \ReflectionObject($obj);
		$invoker = $reflect->getMethod($method);
		$invoker->setAccessible(true);
		return $invoker->invokeArgs($obj, $args);
	}

	/**
	 * プライベートの静的メソッドを呼び出し、結果を取得する
	 *
	 * @param string $class  クラス名
	 * @param string $method メソッド名
	 * @param array  $args   引数リスト
	 * @return mixed メソッドの返却値
	 */
	public static function invokeStaticMethod(string $class, string $method, array $args) {
		$reflect = new \ReflectionClass($class);
		$invoker = $reflect->getMethod($method);
		$invoker->setAccessible(true);
		return $invoker->invokeArgs(null, $args);
	}

	/**
	 * プライベート変数の値を取得する
	 *
	 * @param mixed  $obj  クラスインスタンス
	 * @param string $name メソッド名
	 * @return mixed 変数の値
	 */
	public static function getProperty($obj, string $name) {
		$reflect = new \ReflectionObject($obj);
		$getter = $reflect->getProperty($name);
		$getter->setAccessible(true);
		return $getter->getValue($obj);
	}
}
