<?php
/**
 * Basic implementation of AFK_Plugin that supports pulling settings in from 
 * the database.
 */
abstract class Plugin extends AFK_Plugin {

	private $settings = false;

	/**
	 * Pulls the given setting for this plugin from the settings table.
	 */
	protected function get_setting($name, $default=null) {
		if ($this->settings === false) {
			$this->settings = DAO::get_connection()->query_map("
				SELECT name, value
				FROM   settings
				WHERE  module = %s AND status = %s
				", parent::get_internal_name(), strtolower(STATUS));
		}
		if (array_key_exists($name, $this->settings)) {
			return $this->settings[$name];
		}
		return parent::get_setting($name, $default);
	}
}
