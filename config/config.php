<?php

return array_merge(
	require_once(APP_DIR . '/config/config_default.php'),
	require_once(APP_DIR . "/config/config_{$_SERVER['APP_ENV']}.php")
);
