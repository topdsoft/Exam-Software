<?php
/* Choice Test cases generated on: 2011-06-03 12:01:42 : 1307120502*/
App::import('Model', 'Choice');

class ChoiceTestCase extends CakeTestCase {
	var $fixtures = array('app.choice', 'app.question', 'app.answer', 'app.attempt', 'app.user', 'app.test');

	function startTest() {
		$this->Choice =& ClassRegistry::init('Choice');
	}

	function endTest() {
		unset($this->Choice);
		ClassRegistry::flush();
	}

}
?>