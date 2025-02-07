<?php
/**
 * Class File Autoloader
 * @package Open Directory
 * @since 1.0
 */
spl_autoload_register('opendirectory_autoloader');
function opendirectory_autoloader($class) {
	$namespace = 'OPENDIRECTORY';
 
	if (strpos($class, $namespace) !== 0) {
		return;
	}
 
	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	$path = strtolower(OPENDIRECTORY_PATH . $class);

 
	if (file_exists($path)) {
		require_once($path);
	}
}