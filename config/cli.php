<?php

$di = new \Phalcon\Di\FactoryDefault\Cli();
$di->set('config', function() {
	$paths = [
		APP_DIR . '/config/config_core.php',
		APP_DIR . '/config/config_cli.php',
		APP_DIR . "/config/config_{$_SERVER['APP_ENV']}.php",
	];
	$config = new \Phalcon\Config(require_once(array_shift($paths)));
	foreach ($paths as $path) {
		$config->merge(new \Phalcon\Config(require_once($path)));
	}
	return $config;
});

$loader = new \Phalcon\Loader();
$loader->registerNamespaces($di['config']->loader->namespaces->toArray());
$loader->register();

foreach ($di['config']->di as $key => $definition) {
	$di->set($key, function() use ($definition) {
		$args = $definition->args->toArray();
		if (isset($definition->method)) {
			if ($definition->method === '__construct')  {
				return new $definition->class(...$args);
			} else {
				$depended = new $definition->class();
				$depended->{$definition->method}(...$args);
				return $depended;
			}
		} else if (isset($definition->callback) && is_callable($definition->callback)) {
			$depended = new $definition->class();
			$callback = $definition->callback;
			$callback($depended, ...$args);
			return $depended;
		} else {
			throw new Exception('Invalid di definition', 500);
		}
	});
}

return $di;
