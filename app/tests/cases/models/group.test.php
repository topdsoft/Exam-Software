<?php
/* Group Test cases generated on: 2011-07-01 08:18:02 : 1309526282*/
App::import('Model', 'Group');

class GroupTestCase extends CakeTestCase {
	var $fixtures = array('app.group', 'app.user', 'app.attempt', 'app.exam', 'app.question', 'app.answer', 'app.choice', 'app.image');

	function startTest() {
		$this->Group =& ClassRegistry::init('Group');
	}

	function endTest() {
		unset($this->Group);
		ClassRegistry::flush();
	}

}
?>