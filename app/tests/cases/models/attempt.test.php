<?php
/* Attempt Test cases generated on: 2011-06-03 12:47:43 : 1307123263*/
App::import('Model', 'Attempt');

class AttemptTestCase extends CakeTestCase {
	var $fixtures = array('app.attempt', 'app.user', 'app.exam', 'app.question', 'app.answer', 'app.choice', 'app.image');

	function startTest() {
		$this->Attempt =& ClassRegistry::init('Attempt');
	}

	function endTest() {
		unset($this->Attempt);
		ClassRegistry::flush();
	}

}
?>