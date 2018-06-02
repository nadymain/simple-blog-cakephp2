<?php
/**
 * Slider Fixture
 */
class SliderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 191, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'link' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 191, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'title' => array('column' => 'title', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet',
			'link' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-05-24 14:38:02'
		),
	);

}
