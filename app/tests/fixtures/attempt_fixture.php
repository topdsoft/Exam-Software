<?php
/* Attempt Fixture generated on: 2011-06-03 12:47:42 : 1307123262 */
class AttemptFixture extends CakeTestFixture {
	var $name = 'Attempt';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'exam_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'score' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_id' => array('column' => 'user_id', 'unique' => 0), 'test_id' => array('column' => 'exam_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'exam_id' => 1,
			'date' => '2011-06-03 12:47:42',
			'score' => 1
		),
	);
}
?>