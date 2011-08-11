<?php
/* Question Test cases generated on: 2011-06-03 12:03:34 : 1307120614*/
App::import('Model', 'Question');

class QuestionTestCase extends CakeTestCase {
	var $fixtures = array('app.question', 'app.test', 'app.answer', 'app.attempt', 'app.user', 'app.choice', 'app.image');

	function startTest() {
		$this->Question =& ClassRegistry::init('Question');
	}

	function endTest() {
		unset($this->Question);
		ClassRegistry::flush();
	}

}
?>