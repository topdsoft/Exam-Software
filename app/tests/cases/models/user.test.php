<?php
/* User Test cases generated on: 2011-06-03 12:04:59 : 1307120699*/
App::import('Model', 'User');

class UserTestCase extends CakeTestCase {
	var $fixtures = array('app.user', 'app.attempt', 'app.test', 'app.question', 'app.answer', 'app.choice', 'app.image');

	function startTest() {
		$this->User =& ClassRegistry::init('User');
	}

	function endTest() {
		unset($this->User);
		ClassRegistry::flush();
	}

}
?>