<?php
App::uses('AppHelper', 'View/Helper');

class MenuHelper extends AppHelper {
    
    public $helpers = ['Html'];

	public function main($link) {
        $url = $this->Html->url($link);
        $here = $this->request->here;
		return $url === $here ? 'current' : null;
    }
    
}