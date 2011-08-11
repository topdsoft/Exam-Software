<?php
/* Answer Test cases generated on: 2011-06-03 11:58:34 : 1307120314*/
App::import('Model', 'Answer');

class AnswerTestCase extends CakeTestCase {
	var $fixtures = array('app.answer', 'app.attempt', 'app.question', 'app.choice');

	function startTest() {
		$this->Answer =& ClassRegistry::init('Answer');
	}

	function endTest() {
		unset($this->Answer);
		ClassRegistry::flush();
	}

}
?>