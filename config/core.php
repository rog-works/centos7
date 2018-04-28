<?php

$di = new \Phalcon\Di\FactoryDefault();
$di->set('config', function() {
	return new \Phalcon\Config(require_once(APP_DIR . '/config/config.php'));
});

$di->set('dispatcher', function() {
	$dispatcher = new \Phalcon\Mvc\Dispatcher;
	$dispatcher->setDefaultNamespace($this['config']->dispatcher->namespace);
	return $dispatcher;
});

$di->set('router', function() {
	$router = new \Phalcon\Mvc\Router;
	foreach ($this['config']->routes as $route) {
		$method = sprintf('%s%s', 'add', ucwords(strtolower($route->verb)));
		$router->$method($route->path, $route->map->toArray());
	}
	return $router;
});

$di->set('view', function() {
	$view = new \Phalcon\Mvc\View();
	$view->setViewsDir(APP_DIR . $this['config']->view->baseDir);
	return $view;
});

$di->set('db', function() {
	return new \Phalcon\Db\Adapter\Pdo\Mysql($this['config']->db->toArray());
});

$loader = new \Phalcon\Loader();
$loader->registerNamespaces(
	array_map(
		function($path) { return APP_DIR . $path; },
		$di['config']->namespaces->toArray()
	)
);
$loader->register();

return $di;
