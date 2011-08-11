<?php
class Answer extends AppModel {
	var $name = 'Answer';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Attempt' => array(
			'className' => 'Attempt',
			'foreignKey' => 'attempt_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Question' => array(
			'className' => 'Question',
			'foreignKey' => 'question_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Choice' => array(
			'className' => 'Choice',
			'foreignKey' => 'choice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>