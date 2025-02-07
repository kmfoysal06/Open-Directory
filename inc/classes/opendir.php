<?php
/**
 * Main Class File For The Whole Plugin
 * @package Open Directory
 * @since 1.0
 */
namespace OPENDIRECTORY\Inc\Classes;
use OPENDIRECTORY\Inc\Traits\Singleton;
Class Opendir {
	use Singleton;
	public function __construct() {
		Assets::get_instance();
		Setup::get_instance();

		$this->setup_hooks();
	}

	public function setup_hooks() {

	}

}