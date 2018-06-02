<?php
App::uses('Component', 'Controller');

class cacheSettingsComponent extends Component {
	
/**
 * initialize method
 *
 */
	function initialize(Controller $controller) {
		$cache_settings = Cache::read('cache_settings', 'long');
		if (!$cache_settings) {
			$cache_settings = ClassRegistry::init('Setting')->find('all', array(
				'fields' => array('Setting.set_key', 'Setting.set_value')
			));
			Cache::write('cache_settings', $cache_settings, 'long');
		}
		
		foreach($cache_settings as $setting) {
			if ($setting['Setting']['set_value'] !== null) {
				Configure::write($setting['Setting']['set_key'], $setting['Setting']['set_value']);
			}
		}
		
		return $cache_settings;
	}
	
}