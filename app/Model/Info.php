<?php
App::uses('AppModel', 'Model');
/**
 * Info Model
 *
 */
class Info extends AppModel {

/**
 * actsAs
 */
	public $actsAs = array(
	    'Slugomatic.Slugomatic' => array(
			'overwrite' => true
	    )
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please fill out this field.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Title already taken, must be unique.'
			),
		),
		'slug' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please fill out this field.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Slug already taken, must be unique.'
			),
		),
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Please fill out this field.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
