<?php
/* Attempts Test cases generated on: 2011-06-03 12:49:36 : 1307123376*/
App::import('Controller', 'Attempts');

class TestAttemptsController extends AttemptsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AttemptsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.attempt', 'app.user', 'app.exam', 'app.question', 'app.answer', 'app.choice', 'app.image');

	function startTest() {
		$this->Attempts =& new TestAttemptsController();
		$this->Attempts->constructClasses();
	}

	function endTest() {
		unset($this->Attempts);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>