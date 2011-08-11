<?php
/* Test Test cases generated on: 2011-06-03 12:04:10 : 1307120650*/
App::import('Model', 'Test');

class TestTestCase extends CakeTestCase {
	var $fixtures = array('app.test', 'app.attempt', 'app.user', 'app.answer', 'app.question', 'app.choice', 'app.image');

	function startTest() {
		$this->Test =& ClassRegistry::init('Test');
	}

	function endTest() {
		unset($this->Test);
		ClassRegistry::flush();
	}

}
?>