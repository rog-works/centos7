<?php
return array_merge_recursive(
	require_once(APP_DIR . '/config/core/core.php'),
	require_once(APP_DIR . '/config/app/web.php'),
	require_once(APP_DIR . '/config/env/' . APP_ENV . '.php')
);
