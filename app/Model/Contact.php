<?php
App::uses('AppModel', 'Model');

class Contact extends AppModel {

/**
 * useTable
 */
	public $useTable = false;

/**
 * _schema
 */
	protected $_schema = array(
		'name' => array(
			'type' => 'string', 
			'length' => 45
		),
		'email' => array(
			'type' => 'string', 
			'length' => 65
		),
		'message' => array(
			'type' => 'text'
		)	
	);

/**
 * validate
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill out this field.',
			)
		),
		'email' => array(
			'email' => array(
				'rule' => 'email',
				'message' => 'Please insert your email address.'
			)
		),
		'message' => array(
			'notBlank' => array(
				'rule' => 'notBlank',
				'message' => 'Please fill out this field.',
			)
		)
	);

/**
 * _execute
 */
    public function _execute($data){
        $this->set($data);
        if ($this->validates()) {
        	App::uses('CakeEmail', 'Network/Email');
            $mail = new CakeEmail();
            $mail->to(Configure::read('site_email'))
				->from($data['email'])
                ->subject('Contact Form Site')
				->emailFormat('html')
				->template('contact')
				->viewVars($data)
            	->send();
            return true;
        } else {
            return false;
        }
    }
}